<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout {{ $product->title }} | JUARAMETA</title>
    <meta name="description" content="Checkout pembayaran Midtrans untuk mengunduh aset digital JuaraMeta.">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            color: #eff6ff;
            background:
                radial-gradient(circle at top, rgba(56, 189, 248, 0.35), transparent 35%),
                linear-gradient(135deg, #020617, #0f172a 45%, #1d4ed8 100%);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .checkout-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }
        .checkout-card {
            width: 100%;
            max-width: 720px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 28px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: 0 30px 80px rgba(2, 6, 23, 0.5);
            overflow: hidden;
        }
        .checkout-hero {
            padding: 28px 28px 12px;
            background: linear-gradient(135deg, rgba(59, 130, 246, .22), rgba(14, 165, 233, .08));
        }
        .checkout-body {
            padding: 28px;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(56, 189, 248, 0.15);
            color: #7dd3fc;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .checkout-title {
            margin: 18px 0 10px;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 800;
        }
        .checkout-copy {
            margin: 0;
            color: #cbd5e1;
            line-height: 1.7;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-top: 24px;
        }
        .detail-card {
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,.08);
            background: rgba(15, 23, 42, .72);
            padding: 18px;
        }
        .detail-card span {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        .detail-card strong {
            font-size: 20px;
            color: #f8fafc;
        }
        .checkout-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }
        .btn-premium {
            border: none;
            border-radius: 16px;
            padding: 14px 20px;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(14, 165, 233, .25);
        }
        .btn-pay {
            color: #0f172a;
            background: linear-gradient(135deg, #67e8f9, #38bdf8, #22c55e);
        }
        .btn-ghost {
            color: #e2e8f0;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
        }
        .helper-box {
            margin-top: 22px;
            padding: 18px 20px;
            border-radius: 18px;
            background: rgba(15, 23, 42, .85);
            border: 1px solid rgba(255,255,255,.08);
            color: #cbd5e1;
        }
        .helper-box ul {
            margin: 12px 0 0;
            padding-left: 18px;
        }
    </style>
</head>
<body>
    <main class="checkout-shell">
        @if (session('payment_warning'))
            <div style="position:fixed;top:20px;left:50%;transform:translateX(-50%);z-index:9999;background:#fff3cd;border:1px solid #ffc107;color:#664d03;padding:12px 24px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.15);max-width:600px;width:90%;text-align:center;font-size:14px;">
                <strong>⚠️ Perhatian!</strong> {{ session('payment_warning') }}
            </div>
        @endif
        <section class="checkout-card">
            <div class="checkout-hero">
                <span class="status-pill">Pembayaran Midtrans</span>
                <h1 class="checkout-title">Selesaikan pembayaran untuk download {{ $product->title }}</h1>
                <p class="checkout-copy">Setelah pembayaran diverifikasi, file aset Anda akan langsung diproses untuk diunduh secara otomatis.</p>
            </div>
            <div class="checkout-body">
                <div class="detail-grid">
                    <div class="detail-card">
                        <span>Produk</span>
                        <strong>{{ $product->title }}</strong>
                    </div>
                    <div class="detail-card">
                        <span>Total Pembayaran</span>
                        <strong>Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</strong>
                    </div>
                    <div class="detail-card">
                        <span>Order ID</span>
                        <strong style="font-size:16px">{{ $paymentTransaction->order_id }}</strong>
                    </div>
                </div>

                <div class="checkout-actions">
                    <button type="button" id="pay-now-btn" class="btn-premium btn-pay">Bayar Sekarang</button>
                    <a href="{{ route('product') }}" class="btn-premium btn-ghost text-decoration-none">Kembali ke Produk</a>
                </div>

                <div class="helper-box">
                    <strong>Petunjuk singkat</strong>
                    <ul>
                        <li>Pilih metode pembayaran yang tersedia di popup Midtrans.</li>
                        <li>Setelah pembayaran sukses, Anda akan diarahkan ke proses download otomatis.</li>
                        <li>Jika popup tertutup, klik lagi tombol <em>Bayar Sekarang</em>.</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <script>
        const snapToken = @json($snapToken);
        const finishUrl = @json($finishUrl);
        const retryUrl = @json($retryUrl ?? null);

        function openSnapPayment() {
            if (!snapToken || !window.snap) {
                alert('Snap Midtrans belum siap. Periksa client key Midtrans Anda.');
                return;
            }

            window.snap.pay(snapToken, {
                onSuccess: function () {
                    window.location.href = finishUrl;
                },
                onPending: function () {
                    window.location.href = finishUrl;
                },
                onError: function (result) {
                    // Transaction expired or failed — create a new transaction
                    if (retryUrl) {
                        window.location.href = retryUrl;
                    } else {
                        window.location.href = @json(route('product'));
                    }
                },
                onClose: function () {
                    console.log('User menutup popup pembayaran.');
                }
            });
        }

        document.getElementById('pay-now-btn').addEventListener('click', openSnapPayment);
        window.addEventListener('load', function () {
            setTimeout(openSnapPayment, 500);
        });
    </script>
</body>
</html>
