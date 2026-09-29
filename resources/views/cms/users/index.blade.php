@extends('layouts.cms')

@section('content')
@if(session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-warning shadow-sm">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="mb-1 fw-bold">👥 Pengelolaan User</h1>
            <p class="text-muted mb-0">Kelola akun pengguna, edit profil, reset password, ubah role, atau hapus akun.</p>
        </div>
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">Admin only</span>
    </div>

    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="fw-semibold mb-1">Info password</div>
        <div class="small mb-0">
            Password lama tidak bisa ditampilkan sebagai teks asli karena disimpan aman dalam bentuk hash.
            Admin dapat mengisi password baru untuk mereset password user. Login Google tetap bisa digunakan selama email sama.
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Tambah User</h5>
            <form action="{{ route('users.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label" for="create-user-name">Nama</label>
                    <input id="create-user-name" type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="create-user-email">Email</label>
                    <input id="create-user-email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="create-user-password">Password</label>
                    <div class="input-group">
                        <input id="create-user-password" type="password" name="password" class="form-control js-password-field" required>
                        <button class="btn btn-outline-secondary js-toggle-password" type="button" data-target="create-user-password">Lihat</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="create-user-role">Role</label>
                    <select id="create-user-role" name="role" class="form-select">
                        @foreach($roleOptions as $role)
                            <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-danger w-100">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="min-width: 180px;">Nama</th>
                            <th style="min-width: 220px;">Email</th>
                            <th style="min-width: 130px;">Role</th>
                            <th style="min-width: 170px;">Password</th>
                            <th style="min-width: 120px;">Provider</th>
                            <th style="min-width: 240px;">Password Baru</th>
                            <th class="text-end" style="min-width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <form id="edit-user-{{ $user->id }}" action="{{ route('users.update', $user) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <input form="edit-user-{{ $user->id }}" type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $user->name) }}" required>
                                </td>
                                <td>
                                    <input form="edit-user-{{ $user->id }}" type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}" required>
                                </td>
                                <td>
                                    <select form="edit-user-{{ $user->id }}" name="role" class="form-select form-select-sm">
                                        @foreach($roleOptions as $role)
                                            <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <span class="badge bg-dark-subtle text-dark border">Hash tersimpan</span>
                                    <div class="small text-muted mt-1">Reset melalui password baru.</div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $user->provider_name ? ucfirst($user->provider_name) : '-' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input form="edit-user-{{ $user->id }}" id="edit-user-password-{{ $user->id }}" type="password" name="password" class="form-control js-password-field" placeholder="Kosongkan jika tidak diubah">
                                        <button class="btn btn-outline-secondary js-toggle-password" type="button" data-target="edit-user-password-{{ $user->id }}">Lihat</button>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2 align-items-center justify-content-end flex-wrap">
                                        <button form="edit-user-{{ $user->id }}" type="submit" class="btn btn-sm btn-danger">Simpan</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-top-0">
                                <td colspan="7" class="pt-0 text-end">
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?');" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus User</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.js-toggle-password').forEach((button) => {
            button.addEventListener('click', () => {
                const target = document.getElementById(button.dataset.target);

                if (! target) {
                    return;
                }

                const isHidden = target.type === 'password';
                target.type = isHidden ? 'text' : 'password';
                button.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
            });
        });
    });
</script>
@endsection