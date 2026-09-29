@extends('layouts.app')

@section('content')
    <style>
        .collection-page {
            min-height: 82vh;
            padding: 72px 0;
            background:#f6f6f6;;
        }

        .collection-eyebrow {
            letter-spacing: .18em;
            color: #10b1e9;
        }

        .collection-explore-btn,
        .collection-download-btn {
            border: 0;
            color: #fff !important;
            border-radius: 999px;
            font-weight: 800;
            background: #10b1e9;
            box-shadow: 0 16px 34px rgba(16, 177, 233, .26);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .collection-explore-btn:hover,
        .collection-download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 44px rgba(218, 20, 55, .22);
            filter: brightness(1.04);
        }

        .collection-card {
            height: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .78);
            border-radius: 30px;
            background: rgba(255, 255, 255, .88);
            box-shadow: 0 26px 62px rgba(16, 35, 66, .12);
            backdrop-filter: blur(16px);
            transition: transform .24s ease, box-shadow .24s ease;
        }

        .collection-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 34px 76px rgba(16, 35, 66, .18);
        }

        .collection-cover {
            position: relative;
            height: 220px;
            background: linear-gradient(135deg, #dff3ff, #fff5f7);
            overflow: hidden;
        }

        .collection-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .collection-card:hover .collection-cover img {
            transform: scale(1.05);
        }

        .collection-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            border-radius: 999px;
            padding: 8px 13px;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            background: rgba(10, 125, 180, .92);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .16);
            backdrop-filter: blur(12px);
        }

        .collection-meta {
            border-top: 1px solid #e8f0f8;
            border-bottom: 1px solid #e8f0f8;
            background: linear-gradient(135deg, #f8fbff, #fff7f9);
        }

        .asset-download-panel {
            display: grid;
            gap: 10px;
        }

        .asset-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e6eef7;
            border-radius: 18px;
            background: #fff;
        }

        .asset-icon {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            background: #10b1e9;
        }
    </style>

    <section class="collection-page">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4 flex-wrap gap-3">
                <div>
                    <p class="text-uppercase fw-bold collection-eyebrow mb-2">Library</p>
                    <h1 class="display-6 fw-bold mb-2">My Collection</h1>
                    <p class="text-muted mb-0">Asset yang berhasil kamu beli akan tersimpan di sini dan bisa di-download kembali kapan saja.</p>
                </div>
                <a href="{{ route('product') }}" class="btn collection-explore-btn px-4 py-2" id="collection-explore-products">
                    Jelajahi Produk
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($purchases->isEmpty())
                <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
                    Kamu belum memiliki koleksi yang dibeli. Silakan buka halaman product untuk mulai membeli.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($purchases as $purchase)
                        @php
                            $project = $purchase->project;
                            $assets = collect([
                                ['key' => 'primary', 'label' => 'Asset Utama', 'path' => optional($project)->model_path],
                                ['key' => 'secondary', 'label' => 'Asset Tambahan', 'path' => optional($project)->model_path_2],
                            ])->filter(fn ($asset) => filled($asset['path']));
                        @endphp

                        @if ($project)
                            <div class="col-md-6 col-lg-4">
                                <article class="collection-card">
                                    <div class="collection-cover">
                                        @if ($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                                        @else
                                            <div class="h-100 d-flex align-items-center justify-content-center text-muted fw-semibold">
                                                No Image
                                            </div>
                                        @endif
                                        <span class="collection-badge">Paid</span>
                                    </div>

                                    <div class="card-body p-4">
                                        <h2 class="h5 fw-bold mb-2">{{ $project->title }}</h2>
                                        <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($project->description, 110) }}</p>

                                        <div class="collection-meta rounded-4 p-3 mb-3">
                                            <div class="d-flex justify-content-between gap-3">
                                                <div>
                                                    <div class="small text-muted">Category</div>
                                                    <div class="fw-semibold">{{ optional($project->category)->name ?? '-' }}</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="small text-muted">Paid At</div>
                                                    <div class="fw-semibold">{{ optional($purchase->paid_at)->format('d M Y') ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="asset-download-panel">
                                            @forelse ($assets as $asset)
                                                <div class="asset-row">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="asset-icon">{{ strtoupper(substr(pathinfo($asset['path'], PATHINFO_EXTENSION), 0, 2)) }}</span>
                                                        <div>
                                                            <div class="fw-bold">{{ $asset['label'] }}</div>
                                                            <div class="small text-muted">{{ strtoupper(pathinfo($asset['path'], PATHINFO_EXTENSION)) }}</div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('products.download', ['product' => $project, 'assetKey' => $asset['key']]) }}" class="btn btn-sm collection-download-btn px-3" id="download-asset-{{ $project->id }}-{{ $asset['key'] }}">
                                                        Download
                                                    </a>
                                                </div>
                                            @empty
                                                <div class="alert alert-warning rounded-4 mb-0">
                                                    File asset belum tersedia untuk produk ini.
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
