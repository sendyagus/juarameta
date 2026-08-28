@extends('layouts.app')

@section('content')
    <section class="py-5" style="min-height: 70vh; background: linear-gradient(180deg, #f6fbff 0%, #eef6ff 100%);">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4 flex-wrap gap-3">
                <div>
                    <p class="text-uppercase fw-semibold text-info mb-2" style="letter-spacing: .18em;">Library</p>
                    <h1 class="display-6 fw-bold mb-2">My Collection</h1>
                    <p class="text-muted mb-0">Semua project yang sudah kamu beli tampil di sini.</p>
                </div>
                <a href="{{ route('product') }}" class="btn btn-primary px-4 py-2 rounded-pill" style="background: linear-gradient(135deg, #10b1e9, #0a7db4); border: 0;">
                    Jelajahi Produk
                </a>
            </div>

            @if ($purchases->isEmpty())
                <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
                    Kamu belum memiliki koleksi yang dibeli. Silakan buka halaman product untuk mulai membeli.
                </div>
            @else
                <div class="row g-4">
                    @foreach ($purchases as $purchase)
                        @php $project = $purchase->project; @endphp
                        @if ($project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">
                                    <div style="height: 210px; background: linear-gradient(135deg, #dff3ff, #f4faff);">
                                        @if ($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <div class="h-100 d-flex align-items-center justify-content-center text-muted fw-semibold">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                            <h2 class="h5 fw-bold mb-0">{{ $project->title }}</h2>
                                            <span class="badge rounded-pill text-bg-success">Paid</span>
                                        </div>
                                        <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($project->description, 120) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
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
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
