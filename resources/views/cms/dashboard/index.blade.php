@extends('layouts.cms')

@section('content')
@if(session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
@endif

<div class="container-fluid">
    <h1 class="mb-4 fw-bold">👋 Selamat Datang di Dashboard Admin</h1>

    <div class="row g-4">
        <!-- Card Jumlah Projects -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-primary h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Projects</h5>
                        <h2 class="fw-bold mb-0">{{ $projects }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-kanban-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Products -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-warning h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Products</h5>
                        <h2 class="fw-bold mb-0">{{ $products }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-bag-check-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Partners -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-success h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Partners</h5>
                        <h2 class="fw-bold mb-0">{{ $partners }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Jumlah Categories -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-danger h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Categories</h5>
                        <h2 class="fw-bold mb-0">{{ $categories }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-grid" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Tambahan Opsional (Misal Statistik Lain) -->
        <div class="col-md-12 col-lg-4">
            <div class="card bg-light h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-dark">Statistik Umum</h5>
                        <p class="text-muted mb-0">Dashboard siap digunakan</p>
                    </div>
                    <div>
                        <i class="bi bi-bar-chart-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
