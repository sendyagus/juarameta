<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class MidtransWebhookController extends Controller
{
    public function __invoke(Request $request, PurchaseController $purchaseController)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;

        abort_unless($orderId, 404);

        $transaction = PaymentTransaction::where('order_id', $orderId)->latest('id')->firstOrFail();

        $expectedSignature = hash('sha512', $orderId . ($payload['status_code'] ?? '') . ($payload['gross_amount'] ?? '') . config('midtrans.server_key'));
        abort_unless(($payload['signature_key'] ?? null) === $expectedSignature, 403);

        $purchaseController->applyMidtransStatus($transaction, $payload);

        return response()->json(['received' => true]);
    }
}
