@extends('layouts.app')

@section('hide_footer', true)

@section('content')
    <style>
        /* ===== Account Settings: Full Viewport, No Scroll ===== */
        body.account-settings-page {
            overflow: hidden;
            height: 100vh;
        }

        body.account-settings-page #header {
            background: #fff !important;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .06);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 997;
        }

        body.account-settings-page .navbar a,
        body.account-settings-page .navbar a:focus {
            color: #252525;
        }

        body.account-settings-page .navbar a:hover,
        body.account-settings-page .navbar .active,
        body.account-settings-page .navbar .active:focus,
        body.account-settings-page .navbar li:hover>a {
            color: #10b1e9;
        }

        .profile-page {
            height: calc(100vh - 80px);
            margin-top: 80px;
            padding: 0;
            background: #f6f6f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-shell {
            position: relative;
            width: 100%;
            max-width: 1000px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .profile-card {
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, .76);
            border-radius: 28px;
            overflow: hidden;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 30px 80px rgba(16, 35, 66, .14);
            backdrop-filter: blur(18px);
            width: 100%;
            max-height: calc(100vh - 120px);
            display: flex;
            flex-direction: column;
        }

        .profile-hero {
            padding: 24px 30px;
            color: #fff;
            background: #10b1e9;
            flex-shrink: 0;
        }

        .profile-avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, .8);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .2);
            background: linear-gradient(135deg, #10b1e9);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 900;
        }

        .profile-form-panel {
            padding: 24px 30px;
            flex: 1;
            overflow-y: auto;
        }

        .profile-input {
            min-height: 44px;
            border-radius: 12px;
            border: 1px solid #d9e7f4;
            background: #f8fbff;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .profile-input:focus {
            border-color: #10b1e9;
            box-shadow: 0 0 0 .22rem rgba(16, 177, 233, .13);
            transform: translateY(-1px);
        }

        .profile-save-btn {
            min-height: 46px;
            border: 0;
            border-radius: 999px;
            color: #fff;
            font-weight: 800;
            letter-spacing: .02em;
            background: #10b1e9;
        }

        .profile-save-btn:hover {
            background: #10abdfff;
            color: #fff;
        }

        /* ===== Responsive ===== */
        @media (max-height: 700px) {
            .profile-hero {
                padding: 16px 24px;
            }

            .profile-avatar-preview {
                width: 56px;
                height: 56px;
                font-size: 22px;
            }

            .profile-form-panel {
                padding: 16px 24px;
            }

            .profile-hero h1 {
                font-size: 1.25rem !important;
            }
        }

        @media (max-width: 768px) {
            .profile-page {
                height: auto;
                min-height: calc(100vh - 80px);
            }

            .profile-card {
                max-height: none;
                border-radius: 20px;
            }

            .profile-shell {
                align-items: flex-start;
                padding: 12px;
            }
        }
    </style>

    <section class="profile-page">
        <div class="profile-shell">
            <div class="profile-card">
                <div class="profile-hero">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="Foto profil {{ $user->name }}" class="profile-avatar-preview">
                        @else
                            <div class="profile-avatar-preview">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
                        @endif
                        <div>
                            <p class="text-uppercase fw-bold mb-1" style="letter-spacing: .18em; opacity: .82; font-size: .75rem;">Profile Center</p>
                            <h1 class="h4 fw-bold mb-1">Profil Pengguna</h1>
                            <p class="mb-0 opacity-75 small">Ubah username, foto profil, dan password akun kamu dengan aman.</p>
                        </div>
                    </div>
                </div>

                <div class="profile-form-panel">
                    @if (session('success'))
                        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-3 py-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-3 py-2">
                            <strong>Periksa kembali data berikut:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold small">Username</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control profile-input" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold small">Email</label>
                            <input type="email" id="email" value="{{ $user->email }}" class="form-control profile-input" disabled>
                        </div>

                        <div class="col-12">
                            <label for="avatar" class="form-label fw-bold small">Foto Profil</label>
                            <input type="file" id="avatar" name="avatar" accept="image/png,image/jpeg,image/jpg,image/webp" class="form-control profile-input">
                            <div class="form-text">Format JPG, PNG, atau WEBP. Maksimal 2MB.</div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 rounded-4" style="background: linear-gradient(135deg, #f7fbff); border: 1px solid #e7eef7;">
                                <h2 class="h6 fw-bold mb-2">Ganti Password</h2>
                                <p class="text-muted small mb-3">Kosongkan bagian ini jika tidak ingin mengubah password.</p>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="current_password" class="form-label fw-semibold small">Password Lama</label>
                                        <input type="password" id="current_password" name="current_password" class="form-control profile-input" autocomplete="current-password">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password" class="form-label fw-semibold small">Password Baru</label>
                                        <input type="password" id="password" name="password" class="form-control profile-input" autocomplete="new-password">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password_confirmation" class="form-label fw-semibold small">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control profile-input" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" id="profile-save-button" class="btn profile-save-btn px-5">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.body.classList.add('account-settings-page');
    </script>
@endsection

