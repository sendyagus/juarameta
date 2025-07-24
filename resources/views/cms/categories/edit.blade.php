@extends('layouts.cms')

@section('content')
    <h4 class="mb-3">Edit Category</h4>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label><br>
            <img src="{{ asset('storage/' . $category->image) }}" width="100" class="mb-2">
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <button class="btn btn-warning">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
