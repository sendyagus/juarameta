<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | JUARAMETA</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      /* font-family: 'Orbitron', sans-serif; */
      background-color: #ffffff;
      color: #333;
    }

    .logo {
      display: block;
      margin: 0 auto 25px;
      max-width: 280px;
      animation: fadeIn 1.2s ease;
    }

    .card {
      background: #ffffff;
      border: 1px solid #ddd;
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(216, 0, 50, 0.15);
      animation: fadeInUp 1.2s ease;
    }

    .card-header {
      background: transparent;
      color: #10b1e9;
      text-align: center;
      font-size: 1.5rem;
      font-weight: bold;
      border-bottom: none;
    }

    .form-label {
      color: #333;
      font-weight: 500;
    }

    .form-control {
      background-color: #f8f9fa;
      border: 1px solid #ccc;
      color: #333;
    }

    .form-control:focus {
      border-color: #10b1e9;
      box-shadow: 0 0 8px rgba(0, 112, 216, 0.4);
    }

    .btn-primary {
      background-color: #10b1e9;
      border: none;
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #a80025;
      transform: scale(1.03);
    }

    .btn-link {
      color: #d80032;
    }

    .btn-link:hover {
      color: #a80025;
      text-decoration: underline;
    }

    .social-divider {
      display: flex;
      align-items: center;
      gap: 14px;
      color: #888;
      font-size: 0.9rem;
      margin: 22px 0 16px;
    }

    .social-divider::before,
    .social-divider::after {
      content: "";
      flex: 1;
      height: 1px;
      background: #ddd;
    }

    .social-login-grid {
      /* display: grid; */
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px;
      width:100%;
    }

    .btn-social {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: #ffffff;
      color: #333;
      font-weight: 600;
      padding: 10px 12px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-social:hover {
      border-color: #10b1e9;
      color: #10b1e9;
      box-shadow: 0 0 14px rgba(16, 177, 233, 0.18);
      transform: translateY(-2px);
    }

    .btn-social svg {
      width: 20px;
      height: 20px;
      flex-shrink: 0;
    }

    @media (max-width: 420px) {
      .social-login-grid {
        grid-template-columns: 1fr;
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>

<div class="container min-vh-100 d-flex justify-content-center align-items-center py-4">
  <div class="col-md-6 col-lg-5">
    <img src="{{ asset('assets/img/Logo-Meta.png') }}" alt="Logo" class="logo">

    <div class="card shadow p-4">
      <div class="card-header">REGISTER</div>
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <button id="register-submit" type="submit" class="btn btn-primary px-4">{{ __('Register') }}</button>
            <a class="btn btn-link px-0" href="{{ route('login') }}">Sudah punya akun?</a>
          </div>
        </form>

        <div class="social-divider">atau daftar dengan</div>
        <div class="social-login-grid" aria-label="Opsi daftar sosial">
          <a id="register-google" class="btn-social" href="{{ route('social.redirect', 'google') }}" aria-label="Daftar dengan Google">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Google
          </a>
          <!-- <a id="register-apple" class="btn-social" href="{{ route('social.redirect', 'apple') }}" aria-label="Daftar dengan Apple">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path fill="currentColor" d="M16.37 1.43c0 1.14-.46 2.22-1.2 3.04-.79.88-2.09 1.55-3.16 1.46-.14-1.09.42-2.25 1.16-3.06.82-.9 2.25-1.58 3.2-1.44zM20.54 17.41c-.59 1.31-.87 1.89-1.62 3.04-1.05 1.61-2.53 3.62-4.37 3.64-1.63.02-2.05-1.06-4.27-1.05-2.22.01-2.69 1.08-4.32 1.06-1.84-.02-3.24-1.83-4.29-3.44-2.93-4.48-3.24-9.74-1.43-12.54 1.29-1.99 3.32-3.15 5.23-3.15 1.94 0 3.16 1.07 4.77 1.07 1.56 0 2.51-1.07 4.76-1.07 1.7 0 3.5.93 4.78 2.53-4.2 2.3-3.52 8.3.76 9.91z"/>
            </svg>
            Apple
          </a> -->
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
