<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Buat password baru untuk akun JUARAMETA Anda." />
  <title>Reset Password | JUARAMETA</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background-color: #ffffff;
      overflow-x: hidden;
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
      padding-bottom: 0;
    }

    .auth-subtitle {
      color: #666;
      text-align: center;
      line-height: 1.6;
      margin: 8px auto 22px;
      max-width: 410px;
    }

    .form-label {
      color: #333;
      font-weight: 500;
    }

    .form-control {
      background-color: #f8f9fa;
      border: 1px solid #ccc;
      color: #333;
      border-radius: 8px;
      padding: 11px 13px;
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
      border-radius: 8px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .btn-primary:hover {
      background-color: #11a6d8ff;
      transform: scale(1.03);
    }

    .btn-link {
      color: #d80032;
      text-decoration: none;
    }

    .btn-link:hover {
      color: #a80025;
      text-decoration: underline;
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

<main class="container min-vh-100 d-flex justify-content-center align-items-center py-4">
  <div class="col-md-6 col-lg-5">
    <img src="{{ asset('assets/img/Logo-Meta.png') }}" alt="Logo JUARAMETA" class="logo">

    <section class="card shadow p-4" aria-labelledby="reset-title">
      <div class="card-header" id="reset-title">RESET PASSWORD</div>
      <div class="card-body">
        <p class="auth-subtitle">Buat password baru yang aman untuk akun Anda.</p>

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
          </div>

          <button id="reset-submit" type="submit" class="btn btn-primary w-100">Simpan Password Baru</button>
        </form>

        <div class="text-center mt-3">
          <a class="btn btn-link px-0" href="{{ route('login') }}">Kembali ke login</a>
        </div>
      </div>
    </section>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
