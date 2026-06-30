<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CMS | JUARAMETA</title>

  <!-- Favicons -->
  <link href="{{ asset('assets/img/Logo-Meta.png') }}" rel="icon" />
  <link href="{{ asset('assets/img/Logo-Meta.png') }}" rel="apple-touch-icon" />

  <!-- Bootstrap Icons & Boxicons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Style -->
  <style>
    :root {
      --cms-sidebar-width: 260px;
    }

    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      background-color: #fff;
      padding-top: 2rem;
      height: 100vh;
      overflow-y: auto;
    }

    .sidebar a {
      color: #6c757d;
      padding: 0.75rem 1.5rem;
      display: flex;
      align-items: center;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .sidebar a:hover {
      background-color: #f8d7da;
      color: #dc3545;
    }

    .sidebar .active {
      background-color: #dc3545;
      color: #fff;
      border-left: 5px solid #fff;
    }

    .sidebar a i {
      margin-right: 0.75rem;
      font-size: 1.2rem;
    }

    .desktop-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--cms-sidebar-width);
      z-index: 1030;
      border-right: 1px solid rgba(0, 0, 0, 0.06);
      box-shadow: 0 0.5rem 1.5rem rgba(15, 23, 42, 0.08);
    }

    .cms-main {
      width: 100%;
    }

    .card:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    @media (min-width: 768px) {
      .mobile-toggle {
        display: none;
      }

      .cms-main {
        margin-left: var(--cms-sidebar-width);
        width: calc(100% - var(--cms-sidebar-width));
      }
    }
  </style>

  @stack('styles')
</head>
<body>
  <div class="container-fluid px-0">
    <div class="row flex-nowrap g-0">
      
      <!-- Sidebar for desktop -->
      <div class="col-md-2 d-none d-md-block sidebar desktop-sidebar">
        <div class="text-center">
          <img src="{{ asset('assets/img/Logo-Meta.png') }}" alt="Logo" style="max-width: 70%; margin-bottom: 20px;">
        </div>
        <hr>
        <a href="{{ route('dashboard.index') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
          <i class="bx bx-home-alt"></i> Dashboard
        </a>
        <a href="{{ route('projects.index') }}" class="{{ request()->is('projects*') ? 'active' : '' }}">
          <i class="bx bx-briefcase-alt-2"></i> Projects
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">
          <i class="bx bx-package"></i> Products
        </a>
        <a href="{{ route('partners.index') }}" class="{{ request()->is('partners*') ? 'active' : '' }}">
          <i class="bx bx-user-check"></i> Partners
        </a>
        <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">
          <i class="bx bx-category-alt"></i> Categories
        </a>
      </div>

      <!-- Main Content -->
      <div class="col px-0 cms-main">
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center sticky-top">
          <!-- Toggle Button for Mobile -->
          <button class="btn btn-outline-danger d-md-none mobile-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="bi bi-list"></i>
          </button>
          <span class="fw-semibold text-dark ">👋 Welcome, Admin</span>
          <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
              <i class="bx bx-log-out"></i> Logout
            </button>
          </form>
        </nav>

        <main class="p-4">
          @yield('content')
        </main>
      </div>
    </div>
  </div>

  <!-- Offcanvas Sidebar (Mobile Only) -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body sidebar">
      <a href="{{ route('dashboard.index') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <i class="bx bx-home-alt"></i> Dashboard
      </a>
      <a href="{{ route('projects.index') }}" class="{{ request()->is('projects*') ? 'active' : '' }}">
        <i class="bx bx-briefcase-alt-2"></i> Projects
      </a>
      <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">
        <i class="bx bx-package"></i> Products
      </a>
      <a href="{{ route('partners.index') }}" class="{{ request()->is('partners*') ? 'active' : '' }}">
        <i class="bx bx-user-check"></i> Partners
      </a>
      <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">
        <i class="bx bx-category-alt"></i> Categories
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
