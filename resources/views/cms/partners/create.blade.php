@extends('layouts.cms')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold">➕ Tambah Partner Baru</h1>
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
            <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Partner</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: MetaTekno" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Logo</label>
                    <input type="file" name="logo" class="form-control" required>
                    <small class="text-muted">Ukuran disarankan 1:1. Format PNG/JPG.</small>
                </div>

                <button class="btn btn-danger">
                    <i class="bx bx-save"></i> Simpan Partner
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
