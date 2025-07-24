@extends('layouts.cms')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold">Daftar Partner</h1>
        <a href="{{ route('partners.create') }}" class="btn btn-danger shadow-sm">
            <i class="bx bx-plus"></i> Tambah Partner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $partner->logo) }}"
                                     alt="{{ $partner->name }}"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td class="fw-semibold text-dark">{{ $partner->name }}</td>
                            <td>
                                <a href="{{ route('partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada partner ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
