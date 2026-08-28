@extends('layouts.app')

@section('content')
    <section class="py-5" style="min-height: 70vh; background: linear-gradient(180deg, #f6fbff 0%, #eef6ff 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #10b1e9, #0a7db4);">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(255,255,255,.16); display:flex; align-items:center; justify-content:center; font-size: 24px; font-weight: 800;">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <h1 class="h4 mb-1">Account Setting</h1>
                                    <p class="mb-0 opacity-75">Kelola profil akun kamu di satu tempat.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-light h-100">
                                        <div class="text-muted small mb-2">Nama</div>
                                        <div class="fw-semibold fs-5">{{ $user->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-light h-100">
                                        <div class="text-muted small mb-2">Email</div>
                                        <div class="fw-semibold fs-5 text-break">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-light h-100">
                                        <div class="text-muted small mb-2">Role</div>
                                        <div class="fw-semibold fs-5 text-capitalize">{{ $user->role ?? 'user' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-light h-100">
                                        <div class="text-muted small mb-2">Login Method</div>
                                        <div class="fw-semibold fs-5 text-capitalize">{{ $user->provider_name ?? 'email' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
