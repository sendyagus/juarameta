@extends('layouts.cms')

@push('styles')
<style>
    input[type="file"]::file-selector-button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        margin-right: 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: #bb2d3b;
    }
</style>
@endpush

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold">✏️ Edit Partner</h1>
        <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <form action="{{ route('partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Partner</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $partner->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Logo Saat Ini</label><br>
                    <img src="{{ asset('storage/'.$partner->logo) }}"
                         alt="{{ $partner->name }}"
                         class="rounded shadow-sm"
                         style="width: 100px; height: 100px; object-fit: contain;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ganti Logo (opsional)</label>
                    <input type="file" name="logo" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
                </div>

                <button class="btn btn-danger">
                    <i class="bx bx-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
