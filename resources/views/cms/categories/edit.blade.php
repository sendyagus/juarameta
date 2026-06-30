@extends('layouts.cms')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h4 class="mb-3">
        @if(old('type', $category->type) === 'product')
            🛒 Edit Category Produk
        @else
            📂 Edit Category Landing
        @endif
    </h4>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" {{ $isLocked ? 'disabled' : '' }} required>
                <option value="landing" {{ old('type', $category->type) === 'landing' ? 'selected' : '' }}>Landing</option>
                <option value="product" {{ old('type', $category->type) === 'product' ? 'selected' : '' }}>Product</option>
            </select>
            @if($isLocked)
                <small class="text-muted">Type tidak bisa diubah karena category ini sudah dipakai pada project atau product.</small>
                <input type="hidden" name="type" value="{{ old('type', $category->type) }}">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label><br>
            <img src="{{ asset('storage/' . $category->image) }}" width="100" class="mb-2">
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
