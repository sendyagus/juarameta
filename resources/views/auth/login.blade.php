<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | JUARAMETA</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      /* font-family: 'Orbitron', sans-serif; */
      background-color: #ffffff;
      overflow: hidden;
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
      color: #d80032;
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
      border-color: #d80032;
      box-shadow: 0 0 8px rgba(216, 0, 50, 0.4);
    }

    .btn-primary {
      background-color: #d80032;
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

<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="col-md-6 col-lg-5">
    <img src="{{ asset('assets/img/Logo-Meta.png') }}" alt="Logo" class="logo">

    <div class="card shadow p-4">
      <div class="card-header">LOGIN</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
            @error('password')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary px-4">{{ __('Login') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
