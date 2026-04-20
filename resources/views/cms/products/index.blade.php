@extends('layouts.cms')

@section('content')
@if (session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
@endif
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 py-2">
        <h1 class="h4 fw-bold">Product List</h1>
        <div class="col-md-4 offset-md-5">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan judul..."
                onkeyup="filterProducts()">
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-danger shadow-sm">
            <i class="bx bx-plus"></i> Add Product
        </a>
    </div>

    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top rounded-top-4"
                            alt="{{ $product->title }}" style="object-fit: cover; height: 180px;">
                    @else
                        <div class="bg-secondary text-white text-center py-5 rounded-top-4">No Image</div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark fw-semibold mb-1">
                            {{ $product->title }}
                            <span class="badge bg-secondary">{{ $product->category->name }}</span>
                            @if ($product->is_hot)
                                <span class="badge bg-danger">HOT</span>
                            @endif
                        </h5>
                        <p class="text-muted small flex-grow-1">{{ Str::limit($product->description, 100) }}</p>

                        <div class="mb-2 small">
                            <div><strong>Author:</strong> {{ $product->author ?: 'JuaraMeta' }}</div>
                            <div><strong>Harga:</strong> Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</div>
                        </div>

                        <div class="mb-2">
                            @if ($product->model_path)
                                <a href="{{ asset($product->model_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bx bx-cube"></i> 3D Model
                                </a>
                            @endif
                            @if ($product->spatial_link)
                                <a href="{{ $product->spatial_link }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-link-external"></i> Spatial
                                </a>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-sm btn-warning text-white shadow-sm">
                                <i class="bx bx-edit-alt"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger shadow-sm">
                                    <i class="bx bx-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No products found.</div>
        @endforelse
    </div>
</div>
<script>
    function filterProducts() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.querySelectorAll('.card.h-100');

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            if (title.includes(filter)) {
                card.parentElement.style.display = '';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    }
</script>
@endsection
