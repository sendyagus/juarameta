@extends('layouts.cms')

@section('content')
    <h4 class="mb-3">
        @if(old('type', $type) === 'product')
            🛒 Add New Category Produk
        @else
            📂 Add New Category Landing
        @endif
    </h4>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="landing" {{ old('type', $type) === 'landing' ? 'selected' : '' }}>Landing</option>
                <option value="product" {{ old('type', $type) === 'product' ? 'selected' : '' }}>Product</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button class="btn btn-danger">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
