@extends('layouts.cms')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ============================================= --}}
    {{-- SECTION 1: KATEGORI LANDING PAGE              --}}
    {{-- ============================================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">📂 Kategori Landing Page</h4>
        <a href="{{ route('categories.create', ['type' => 'landing']) }}" class="btn btn-danger shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add Category Landing
        </a>
    </div>

    <div class="row">
        @forelse ($landingCategories as $category)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <img 
                        src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/img/default-category.jpg') }}" 
                        class="card-img-top rounded-top" 
                        alt="{{ $category->name }}" 
                        style="height: 200px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem;">
                            {{ Str::limit($category->description, 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Belum ada kategori landing page. <a href="{{ route('categories.create', ['type' => 'landing']) }}">Tambah baru</a>.
                </div>
            </div>
        @endforelse
    </div>

    <hr class="my-5" style="border-top: 2px dashed #dee2e6;">

    {{-- ============================================= --}}
    {{-- SECTION 2: KATEGORI PRODUK KATALOG            --}}
    {{-- ============================================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">🛒 Kategori Produk Katalog</h4>
       
    </div>

    <div class="row">
        @forelse ($productCategories as $category)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-shadow" style="border-left: 4px solid #0d6efd !important;">
                    <img 
                        src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/img/default-category.jpg') }}" 
                        class="card-img-top rounded-top" 
                        alt="{{ $category->name }}" 
                        style="height: 200px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem;">
                            {{ Str::limit($category->description, 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada kategori produk katalog. <a href="{{ route('categories.create', ['type' => 'product']) }}">Tambah baru</a>.
                </div>
            </div>
        @endforelse
    </div>
@endsection
