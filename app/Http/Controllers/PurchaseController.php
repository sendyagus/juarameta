<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Models\Project;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function start(Request $request, Project $product, string $assetKey = 'primary')
    {
        abort_unless($product->is_product, 404);
        abort_unless(in_array($assetKey, ['primary', 'secondary'], true), 404);
        abort_unless($this->resolveAssetPath($product, $assetKey), 404);

        $user = $request->user();
        $purchase = Purchase::firstOrCreate(
            [
                'user_id' => $user->id,
                'project_id' => $product->id,
            ],
            [
                'status' => 'pending',
            ]
        );

        if ($purchase->status === 'paid') {
            return redirect()->route('products.download', [
                'product' => $product,
                'assetKey' => $assetKey,
            ]);
        }

        $existingTransaction = PaymentTransaction::where('purchase_id', $purchase->id)
            ->whereIn('status', ['pending', 'challenge'])
            ->latest('id')
            ->first();

        // Verify with Midtrans if the pending transaction is still valid
        if ($existingTransaction && $existingTransaction->snap_token) {
            $statusResponse = Http::withBasicAuth(config('midtrans.server_key'), '')
                ->acceptJson()
                ->get(config('midtrans.api_base_url') . '/v2/' . $existingTransaction->order_id . '/status');

            if ($statusResponse->successful()) {
                $this->applyMidtransStatus($existingTransaction, $statusResponse->json());
                $existingTransaction->refresh();
            }

            // Only reuse the token if the transaction is still pending/challenge and not expired
            if (in_array($existingTransaction->status, ['pending', 'challenge']) &&
                (!$existingTransaction->expiry_time || $existingTransaction->expiry_time->isFuture())) {
                return view('checkout', [
                    'product' => $product,
                    'assetKey' => $assetKey,
                    'snapToken' => $existingTransaction->snap_token,
                    'paymentTransaction' => $existingTransaction,
                    'downloadUrl' => route('products.download', ['product' => $product, 'assetKey' => $assetKey]),
                    'finishUrl' => route('purchases.finish', ['orderId' => $existingTransaction->order_id, 'assetKey' => $assetKey]),
                    'retryUrl' => route('purchases.start', ['product' => $product, 'assetKey' => $assetKey]),
                ]);
            }
        }

        $orderId = 'JM-' . $product->id . '-' . $user->id . '-' . now()->format('YmdHis');

        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $product->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [[
                'id' => (string) $product->id,
                'price' => (int) $product->price,
                'quantity' => 1,
                'name' => mb_substr($product->title, 0, 50),
                'brand' => 'JuaraMeta',
                'category' => optional($product->category)->name,
            ]],
            'callbacks' => [
                'finish' => route('purchases.finish', ['orderId' => $orderId, 'assetKey' => $assetKey]),
            ],
        ];

        $response = Http::withBasicAuth(config('midtrans.server_key'), '')
            ->acceptJson()
            ->post(config('midtrans.api_base_url') . '/snap/v1/transactions', $payload);

        if ($response->failed()) {
            Log::warning('Midtrans Snap transaction creation failed', [
                'status' => $response->status(),
                'response' => $response->json() ?: $response->body(),
                'order_id' => $orderId,
            ]);

            $message = $response->json('error_messages.0')
                ?: $response->json('status_message')
                ?: 'Gagal membuat transaksi Midtrans Sandbox. Periksa server key, client key, dan nominal produk.';

            return back()->with('payment_error', $message);
        }

        $responseData = $response->json();

        $paymentTransaction = DB::transaction(function () use ($purchase, $user, $product, $assetKey, $orderId, $payload, $responseData) {
            $purchase->update([
                'last_order_id' => $orderId,
            ]);

            return PaymentTransaction::create([
                'purchase_id' => $purchase->id,
                'user_id' => $user->id,
                'project_id' => $product->id,
                'order_id' => $orderId,
                'gross_amount' => (int) $product->price,
                'currency' => 'IDR',
                'status' => 'pending',
                'asset_key' => $assetKey,
                'snap_token' => $responseData['token'] ?? null,
                'snap_redirect_url' => $responseData['redirect_url'] ?? null,
                'raw_request' => $payload,
                'raw_response' => $responseData,
            ]);
        });

        return view('checkout', [
            'product' => $product,
            'assetKey' => $assetKey,
            'snapToken' => $paymentTransaction->snap_token,
            'paymentTransaction' => $paymentTransaction,
            'downloadUrl' => route('products.download', ['product' => $product, 'assetKey' => $assetKey]),
            'finishUrl' => route('purchases.finish', ['orderId' => $paymentTransaction->order_id, 'assetKey' => $assetKey]),
            'retryUrl' => route('purchases.start', ['product' => $product, 'assetKey' => $assetKey]),
        ]);
    }

    public function finish(Request $request, string $orderId, string $assetKey = 'primary')
    {
        $transaction = PaymentTransaction::where('order_id', $orderId)
            ->where('user_id', Auth::id())
            ->latest('id')
            ->firstOrFail();

        $response = Http::withBasicAuth(config('midtrans.server_key'), '')
            ->acceptJson()
            ->get(config('midtrans.api_base_url') . '/v2/' . $orderId . '/status');

        if ($response->successful()) {
            $this->applyMidtransStatus($transaction, $response->json());
            $transaction->refresh();
        }

        if ($transaction->isPaid()) {
            return redirect()->route('products.download', [
                'product' => $transaction->project_id,
                'assetKey' => $assetKey,
            ])->with('success', 'Pembayaran berhasil. File siap diunduh.');
        }

        // If expired, redirect to start a new transaction
        if ($transaction->status === 'expired') {
            return redirect()->route('purchases.start', [
                'product' => $transaction->project_id,
                'assetKey' => $assetKey,
            ])->with('payment_warning', 'Transaksi sebelumnya sudah kedaluwarsa. Silakan lakukan pembayaran ulang.');
        }

        return redirect()->route('product')->with('payment_error', 'Pembayaran belum berhasil diselesaikan. Silakan coba lagi.');
    }

    public function download(Request $request, Project $product, string $assetKey = 'primary')
    {
        abort_unless($product->is_product, 404);
        abort_unless(in_array($assetKey, ['primary', 'secondary'], true), 404);

        $purchase = Purchase::where('user_id', $request->user()->id)
            ->where('project_id', $product->id)
            ->where('status', 'paid')
            ->firstOrFail();

        $relativePath = $this->resolveAssetPath($product, $assetKey);
        abort_unless($relativePath, 404);

        $absolutePath = storage_path('app/public/' . $relativePath);
        abort_unless(file_exists($absolutePath), 404);

        $filename = $product->title . '-' . $assetKey . '.' . pathinfo($relativePath, PATHINFO_EXTENSION);

        return response()->download($absolutePath, $filename);
    }

    public function applyMidtransStatus(PaymentTransaction $transaction, array $payload): void
    {
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        $mappedStatus = match ($transactionStatus) {
            'capture' => $fraudStatus === 'challenge' ? 'challenge' : 'paid',
            'settlement' => 'paid',
            'pending' => 'pending',
            'deny' => 'denied',
            'expire' => 'expired',
            'cancel' => 'cancelled',
            default => $transactionStatus ?? 'unknown',
        };

        DB::transaction(function () use ($transaction, $payload, $mappedStatus) {
            $transaction->update([
                'status' => $mappedStatus,
                'payment_type' => $payload['payment_type'] ?? $transaction->payment_type,
                'transaction_id' => $payload['transaction_id'] ?? $transaction->transaction_id,
                'transaction_time' => $payload['transaction_time'] ?? $transaction->transaction_time,
                'settlement_time' => $payload['settlement_time'] ?? $transaction->settlement_time,
                'expiry_time' => $payload['expiry_time'] ?? $transaction->expiry_time,
                'fraud_status' => $payload['fraud_status'] ?? $transaction->fraud_status,
                'raw_notification' => $payload,
                'raw_response' => $payload,
            ]);

            if ($mappedStatus === 'paid') {
                $transaction->purchase()->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                    'last_order_id' => $transaction->order_id,
                ]);
            }
        });
    }

    protected function resolveAssetPath(Project $product, string $assetKey): ?string
    {
        return $assetKey === 'secondary'
            ? $product->model_path_2
            : $product->model_path;
    }
}
