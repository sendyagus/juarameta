<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>JUARAMETA - Product</title>
    <meta name="description" content="Koleksi 3D Model eksklusif berkualitas tinggi dari JuaraMeta untuk metaverse dan simulasi." />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo-Meta.png') }}" />
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6f8;
            color: #2d3340;
        }
        /* Product page uses the shared navbar styles from assets/css/style.css. */

        /* -- LAYOUT -- */
        .product-wrapper { padding: 44px 0 70px; }
        /* â”€â”€ HERO â”€â”€ */
        .product-hero {
            border-radius: 14px;
            background: linear-gradient(130deg, #d7ebfc 0%, #c7e3fb 55%, #b9dcfb 100%);
            padding: 48px 40px;
            margin-bottom: 8px;
            overflow: hidden;
        }
        .product-hero h2 {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
            color: #1a3a5c;
        }
        .product-hero h2 .brand { color: #10a2e9; }
        .product-hero p {
            color: #4a596f;
            max-width: 95%;
            margin-bottom: 28px;
            font-size: 15px;
            line-height: 1.7;
        }
        .btn-collection {
            background: #0ba0df;
            border: 0;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            padding: 12px 26px;
            text-decoration: none;
            display: inline-block;
            transition: background .2s, transform .2s;
        }
        .btn-collection:hover {
            background: #0990c9;
            color: #fff;
            transform: translateY(-1px);
        }
        .hero-model-wrap {
            position: relative;
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-model-viewer {
            width: 100%;
            height: 340px;
            --progress-bar-color: #10a2e9;
            background: transparent;
            filter: drop-shadow(0 18px 28px rgba(26, 58, 92, 0.18));
        }

        /* â”€â”€ TOOLBAR â”€â”€ */
        .toolbar { margin: 28px 0 24px; display: flex; gap: 14px; }
        .filter-select { max-width: 190px; border-radius: 10px; border: 1px solid #dce3ed; height: 48px; }
        .search-box { border-radius: 26px; border: 1px solid #dce3ed; height: 48px; }

        /* â”€â”€ PRODUCT CARD â”€â”€ */
        .product-card {
            background: #fff;
            border: 1px solid #e4e8ee;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(0,0,0,.10);
        }
        .product-thumb {
            height: 195px;
            background: #eceef2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a9b2bf;
            font-size: 18px;
            overflow: hidden;
        }
        .product-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .product-body { padding: 16px 16px 14px; }
        .chip {
            position: absolute;
            top: 10px; right: 10px;
            font-size: 11px;
            padding: 4px 7px;
            border-radius: 5px;
            color: #fff;
            background: #737984;
        }
        .product-title { font-size: 20px; margin-bottom: 8px; font-weight: 700; min-height: 45px; }
        .product-desc { color: #6f7a8d; font-size: 13px; min-height: 40px; margin-bottom: 14px; }
        .product-footer {
            border-top: 1px solid #edf1f6;
            padding-top: 11px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-author { color: #9aa4b4; font-size: 13px; }
        .product-price { color: #2b69f0ff; font-size: 22px; font-weight: 700; }

        /* â”€â”€ MODAL â”€â”€ */
        .modal-xl { max-width: 1000px; }

        .modal-product .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }
        .modal-product .modal-header {
            background: linear-gradient(135deg, #2b69f0ff 0%, #2b69f0ff 100%);
            border: none;
            padding: 18px 24px;
        }
        .modal-product .modal-title { color: #fff; font-weight: 700; font-size: 20px; }
        .modal-product .btn-close { filter: invert(1); }
        .modal-product .modal-body { padding: 0; }
        .modal-product .modal-footer {
            background: #f8f9fc;
            border-top: 1px solid #e8ecf3;
            padding: 14px 24px;
        }

        /* 3D Viewer */
        .viewer-wrap {
            background: linear-gradient(160deg, #291dacff, #2b69f0ff, #291dacff);
            height: 420px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        model-viewer {
            width: 100%;
            height: 420px;
            --progress-bar-color: #e03333;
        }
        .viewer-no-model {
            color: #aab;
            text-align: center;
            padding: 40px;
        }
        .viewer-no-model i { font-size: 64px; display: block; margin-bottom: 12px; opacity: .4; }

        /* Detail panel */
        .detail-panel { padding: 28px 28px 20px; }
        .detail-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            background: #eef2ff;
            color: #4361ee;
            margin-bottom: 14px;
        }
        .detail-badge.hot { background: #fff0f0; color: #e03333; }
        .detail-title { font-size: 26px; font-weight: 800; margin-bottom: 10px; color: #1a1a2e; }
        .detail-desc { color: #6c757d; font-size: 14px; line-height: 1.7; margin-bottom: 20px; }
        .detail-meta-row {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .detail-meta-item label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #aab;
            display: block;
            margin-bottom: 3px;
        }
        .detail-meta-item span {
            font-size: 14px;
            font-weight: 600;
            color: #2d3340;
        }
        .detail-price {
            font-size: 34px;
            font-weight: 800;
            color: #2b69f0;
        }
        .detail-price small { font-size: 14px; font-weight: 500; color: #aaa; }

        .model-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,.2);
            color: #fff;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
        }
        .spatial-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: opacity .2s;
        }
        .spatial-btn:hover { opacity: .85; color: #fff; }
        .ar-btn {
            --ar-button-background: #e03333;
        }

        @media (max-width: 991px) {
            .product-hero { padding: 32px 24px; }
            .hero-model-wrap,
            .hero-model-viewer { height: 280px; }
        }
        /* ===== Navbar Auth Menu ===== */
        .navbar-auth {
            display: flex;
            align-items: center;
            margin-left: 18px;
            position: relative;
            z-index: 1001;
        }

        .navbar-login-btn {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 20px !important;
            border-radius: 999px;
            background: linear-gradient(135deg, #10b1e9 0%, #0a7db4 100%);
            color: #fff !important;
            font-weight: 700;
            letter-spacing: .02em;
            text-decoration: none;
            box-shadow: 0 12px 24px rgba(16, 177, 233, .24);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .navbar-login-btn:hover,
        .navbar-login-btn:focus {
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(16, 177, 233, .32);
            filter: brightness(1.04);
        }

        .navbar-user-menu {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .navbar-user-trigger {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-height: 46px;
            padding: 6px 12px 6px 6px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 999px;
            background: rgba(255, 255, 255, .92);
            /* box-shadow: 0 10px 24px rgba(14, 36, 66, .1); */
            /* color: #1c2430; */
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .navbar-user-trigger:hover,
        .navbar-user-menu:focus-within .navbar-user-trigger {
            transform: translateY(-2px);
            /* border-color: rgba(16, 177, 233, .4);
            box-shadow: 0 16px 30px rgba(14, 36, 66, .14); */
        }

        .navbar-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            background: linear-gradient(135deg, #10b1e9, #7dd3fc);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }

        .navbar-user-avatar--fallback {
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .22);
        }

        .navbar-user-dropdown {
            position: absolute;
            top: calc(100% + 14px);
            right: 0;
            min-width: 260px;
            padding: 10px;
            border-radius: 18px;
            background: rgba(12, 18, 28, .96);
            color: #fff;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .24);
            backdrop-filter: blur(16px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px) scale(.98);
            transition: opacity .2s ease, visibility .2s ease, transform .2s ease;
        }

        .navbar-user-menu:hover .navbar-user-dropdown,
        .navbar-user-menu:focus-within .navbar-user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .navbar-user-info {
            padding: 10px 12px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            margin-bottom: 8px;
        }

        .navbar-user-info strong,
        .navbar-user-info span {
            display: block;
        }

        .navbar-user-info strong {
            font-size: 14px;
            line-height: 1.3;
        }

        .navbar-user-info span {
            margin-top: 4px;
            color: rgba(255, 255, 255, .68);
            font-size: 12px;
            word-break: break-word;
        }

        .navbar-user-link,
        .navbar-user-logout {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: flex-start !important;
            gap: 10px;
            padding: 11px 12px !important;
            border: 0;
            border-radius: 12px;
            background: transparent;
            color: #fff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            transition: background .18s ease, transform .18s ease;
        }

        .navbar-user-link:hover,
        .navbar-user-logout:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff !important;
            transform: translateX(2px);
        }

        .navbar-logout-form {
            margin: 0;
        }

        @media (max-width: 991px) {
            .navbar-auth {
                margin-left: auto;
                margin-right: 12px;
            }

            .navbar-user-dropdown {
                right: 0;
                left: auto;
            }
        }
    </style>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex align-items-center  px-5">
            <h1 class="logo me-auto">
                <a href="{{ route('home') }}"><img style="max-height: 60px" src="{{ asset('assets/img/Logo-Meta.png') }}" alt="JuaraMeta" /></a>
            </h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#about">About</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#gallery">Project</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#faqs">FaQs</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#contact">Contact</a></li>
                    <li><a class="nav-link active" href="{{ route('product') }}">Product</a></li>
                </ul>

                <div class="navbar-auth">
                    @guest
                        <a href="{{ route('login') }}" class="navbar-login-btn" id="product-navbar-login-btn">Login</a>
                    @else
                        <div class="navbar-user-menu" id="product-navbar-user-menu">
                            <button type="button" class="navbar-user-trigger" aria-label="User menu">
                                @if (auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="navbar-user-avatar">
                                @else
                                    <span class="navbar-user-avatar navbar-user-avatar--fallback">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </span>
                                @endif
                                <!-- <i class="bi bi-chevron-down"></i> -->
                            </button>

                            <div class="navbar-user-dropdown" id="product-navbar-user-dropdown">
                                <div class="navbar-user-info">
                                    <strong>{{ auth()->user()->name }}</strong>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <a href="{{ url('/my-collection') }}" class="navbar-user-link">My Collection</a>
                                <a href="{{ route('profile.edit') }}" class="navbar-user-link">Account Setting</a>
                                <form action="{{ route('logout') }}" method="POST" class="navbar-logout-form">
                                    @csrf
                                    <button type="submit" class="navbar-user-link navbar-user-logout">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <main class="product-wrapper" style="padding-top: 100px;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('payment_error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                    {{ session('payment_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('payment_warning'))
                <div class="alert alert-warning alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <strong>Perhatian!</strong> {{ session('payment_warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- === HERO: teks kiri, model 3D kanan === --}}
            <section class="product-hero">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h2>Selamat Datang di <span class="brand">JuaraMeta Assets</span></h2>
                        <p>Temukan berbagai koleksi 3D Model eksklusif berkualitas tinggi. Dirancang khusus untuk
                            mempercepat proses pengembangan dunia metaverse dan simulasi Anda.</p>
                        <a href="#product-grid" class="btn-collection">Jelajahi Koleksi</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-model-wrap">
                            <model-viewer
                                class="hero-model-viewer"
                                src="{{ asset('assets/3d/tekno.glb') }}"
                                alt="Universitas Teknokrat Indonesia"
                                camera-controls
                                auto-rotate
                                shadow-intensity="1.2"
                                exposure="1"
                                interaction-prompt="none"
                                 camera-orbit="0deg 75deg 60%"
                            ></model-viewer>
                        </div>
                    </div>
                </div>
            </section>

            {{-- === TOOLBAR === --}}
            <div class="toolbar">
                <select id="categoryFilter" class="form-select filter-select">
                    <option value="all">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <input id="searchInput" type="text" class="form-control search-box"
                    placeholder="Cari 3D model (misal: kursi kelas, gedung, avatar)..">
            </div>

            {{-- === PRODUCT GRID === --}}
            <div id="product-grid" class="row g-3">
                @forelse ($projects as $project)
                    <div class="col-lg-4 col-md-6 product-item"
                        data-category="{{ $project->category_id }}"
                        data-title="{{ strtolower($project->title) }}"
                        data-description="{{ strtolower($project->description) }}">

                        <article class="product-card position-relative"
                            onclick="openProductModal({
                                id: {{ $project->id }},
                                title: {{ json_encode($project->title) }},
                                description: {{ json_encode($project->description ?? '') }},
                                price: {{ $project->price ?? 0 }},
                                author: {{ json_encode($project->author ?? 'JuaraMeta') }},
                                category: {{ json_encode(optional($project->category)->name ?? '3D Item') }},
                                image: {{ json_encode($project->image ? asset('storage/'.$project->image) : null) }},
                                model_path: {{ json_encode($project->model_path ? asset('storage/'.$project->model_path) : null) }},
                                model_ext: {{ json_encode($project->model_path ? strtolower(pathinfo($project->model_path, PATHINFO_EXTENSION)) : null) }},
                                model_path_2: {{ json_encode($project->model_path_2 ? asset('storage/'.$project->model_path_2) : null) }},
                                model_ext_2: {{ json_encode($project->model_path_2 ? strtolower(pathinfo($project->model_path_2, PATHINFO_EXTENSION)) : null) }},
                                purchase_primary_url: {{ json_encode(route('purchases.start', ['product' => $project, 'assetKey' => 'primary'])) }},
                                purchase_secondary_url: {{ json_encode(route('purchases.start', ['product' => $project, 'assetKey' => 'secondary'])) }},
                                download_primary_url: {{ json_encode(route('products.download', ['product' => $project, 'assetKey' => 'primary'])) }},
                                download_secondary_url: {{ json_encode(route('products.download', ['product' => $project, 'assetKey' => 'secondary'])) }},
                                is_purchased: {{ in_array($project->id, $purchasedProjectIds, true) ? 'true' : 'false' }},
                                is_logged_in: {{ $isLoggedIn ? 'true' : 'false' }},
                                spatial_link: {{ json_encode($project->spatial_link ?? null) }},
                                is_hot: {{ $project->is_hot ? 'true' : 'false' }}
                            })">

                            <span class="chip">{{ optional($project->category)->name ?: '3D Item' }}</span>
                            <div class="product-thumb">
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                                @else
                                    <span style="opacity:.4">Preview Gambar</span>
                                @endif
                            </div>
                            <div class="product-body">
                                <h3 class="product-title">{{ $project->title }}</h3>
                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($project->description, 90) }}</p>
                                <div class="product-footer">
                                    <span class="product-author">Oleh: {{ $project->author ?: 'JuaraMeta' }}</span>
                                    <span class="product-price">Rp {{ number_format($project->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center mb-0">Belum ada produk yang bisa ditampilkan.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    {{-- ===== MODAL DETAIL PRODUK ===== --}}
    <div class="modal fade modal-product" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductTitle">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-0">

                        {{-- === 3D / IMAGE VIEWER (kiri/atas) === --}}
                        <div class="col-lg-7">
                            <div class="viewer-wrap" id="viewerWrap">
                                {{-- diisi JS --}}
                            </div>
                        </div>

                        {{-- === INFO PANEL (kanan/bawah) === --}}
                        <div class="col-lg-5">
                            <div class="detail-panel">
                                <div id="modalBadges"></div>
                                <h2 class="detail-title" id="modalTitle">-</h2>
                                <p class="detail-desc" id="modalDesc">-</p>

                                <div class="detail-meta-row">
                                    <div class="detail-meta-item">
                                        <label>Kategori</label>
                                        <span id="modalCategory">-</span>
                                    </div>
                                    <div class="detail-meta-item">
                                        <label>Author</label>
                                        <span id="modalAuthor">-</span>
                                    </div>
                                    <div class="detail-meta-item">
                                        <label>Format File</label>
                                        <span  id="modalFormat">-</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Harga</small>
                                    <div class="detail-price" id="modalPrice">-</div>
                                </div>

                                <div class="mt-4 pt-3 border-top" id="downloadSection">
                                    <label class="form-label fw-bold text-dark mb-2"><i class="bi bi-download"></i> Pilihan Unduh Aset</label>
                                    <p class="text-muted small mb-3" id="downloadSectionHint">Login diperlukan sebelum download. Setelah login, pembayaran Midtrans akan ditampilkan untuk aset yang belum dibeli.</p>
                                    <div class="d-grid gap-2" id="downloadButtonsContainer">
                                        <!-- Tombol download akan di-generate via JavaScript -->
                                    </div>
                                </div>

                                <div id="modalSpatialWrap" class="mt-3 d-none">
                                    <a id="modalSpatialLink" href="#" target="_blank" class="spatial-btn">
                                        ðŸŒ Buka di Spatial.io
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <small class="text-muted me-auto" id="modalViewerHint"></small>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        /* â”€â”€ HEADER SCROLL EFFECT â”€â”€ */
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        });
        // Trigger on load
        if (window.scrollY > 50) {
            document.getElementById('header').classList.add('header-scrolled');
        }

        /* â”€â”€ MOBILE NAV TOGGLE (same as home) â”€â”€ */
        const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
        if (mobileNavToggle) {
            mobileNavToggle.addEventListener('click', function (e) {
                e.preventDefault();
                document.body.classList.toggle('navbar-mobile');
                const icon = this;
                icon.classList.toggle('bi-list');
                icon.classList.toggle('bi-x');
            });
        }

        // Close mobile nav when clicking a link
        document.querySelectorAll('.navbar-mobile a').forEach(function (link) {
            link.addEventListener('click', function () {
                document.body.classList.remove('navbar-mobile');
                const icon = document.querySelector('.mobile-nav-toggle');
                icon.classList.add('bi-list');
                icon.classList.remove('bi-x');
            });
        });

        /* â”€â”€ FILTER & SEARCH â”€â”€ */
        const categoryFilter = document.getElementById('categoryFilter');
        const searchInput    = document.getElementById('searchInput');
        const productItems   = document.querySelectorAll('.product-item');

        function filterProducts() {
            const sel   = categoryFilter.value;
            const query = searchInput.value.trim().toLowerCase();
            productItems.forEach(item => {
                const okCat    = sel === 'all' || item.dataset.category === sel;
                const okSearch = item.dataset.title.includes(query) || item.dataset.description.includes(query);
                item.style.display = (okCat && okSearch) ? '' : 'none';
            });
        }
        categoryFilter.addEventListener('change', filterProducts);
        searchInput.addEventListener('input', filterProducts);

        /* â”€â”€ MODAL â”€â”€ */
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));

        function formatRupiah(n) {
            return 'Rp ' + Number(n).toLocaleString('id-ID');
        }

        function openProductModal(p) {
            // Header title
            document.getElementById('modalProductTitle').textContent = p.title;

            // Badges
            let badges = `<span class="detail-badge">${p.category}</span>`;
            if (p.is_hot) badges += ` <span class="detail-badge hot">ðŸ”¥ HOT</span>`;
            document.getElementById('modalBadges').innerHTML = badges;

            // Info
            document.getElementById('modalTitle').textContent    = p.title;
            document.getElementById('modalDesc').textContent     = p.description || 'Tidak ada deskripsi.';
            document.getElementById('modalCategory').textContent = p.category;
            document.getElementById('modalAuthor').textContent   = p.author;
            document.getElementById('modalPrice').textContent    = formatRupiah(p.price);

            // Format badge
            const fmtEl = document.getElementById('modalFormat');
            let formats = [];
            if (p.model_ext) formats.push(`.${p.model_ext.toUpperCase()}`);
            if (p.model_ext_2) formats.push(`.${p.model_ext_2.toUpperCase()}`);
            
            if (formats.length > 0) {
                fmtEl.innerHTML = `<span style="font-weight:700;font-size:13px;color:#2b69f0;">${formats.join(' / ')}</span>`;
            } else {
                fmtEl.textContent = 'Tidak ada file aset';
            }

            // Generate Download Buttons
            const downloadSection = document.getElementById('downloadSection');
            const downloadSectionHint = document.getElementById('downloadSectionHint');
            const downloadButtonsContainer = document.getElementById('downloadButtonsContainer');
            downloadButtonsContainer.innerHTML = '';

            let hasDownloads = false;

            const buttonConfigs = [
                {
                    available: Boolean(p.model_path),
                    ext: p.model_ext ? p.model_ext.toUpperCase() : 'Aset 1',
                    title: 'Aset Pilihan 1',
                    buttonClass: 'btn btn-primary w-100 d-flex justify-content-between align-items-center py-2 px-3 rounded-3 text-start text-white',
                    badgeClass: 'badge bg-white text-primary',
                    url: p.is_purchased ? p.download_primary_url : p.purchase_primary_url,
                },
                {
                    available: Boolean(p.model_path_2),
                    ext: p.model_ext_2 ? p.model_ext_2.toUpperCase() : 'Aset 2',
                    title: 'Aset Pilihan 2',
                    buttonClass: 'btn btn-success w-100 d-flex justify-content-between align-items-center py-2 px-3 rounded-3 text-start text-white',
                    badgeClass: 'badge bg-white text-success',
                    url: p.is_purchased ? p.download_secondary_url : p.purchase_secondary_url,
                }
            ];

            buttonConfigs.forEach(config => {
                if (!config.available) {
                    return;
                }

                hasDownloads = true;

                const actionLabel = p.is_purchased
                    ? 'Download Sekarang'
                    : (p.is_logged_in ? 'Bayar & Download' : 'Login untuk Beli');

                const button = document.createElement('a');
                button.href = config.url;
                button.className = config.buttonClass;
                button.innerHTML = `
                    <div>
                        <i class="bi bi-file-earmark-arrow-down-fill me-2 fs-5"></i>
                        <strong>${config.title}</strong>
                        <div class="small text-white-50 mt-1">${actionLabel}</div>
                    </div>
                    <span class="${config.badgeClass}">.${config.ext}</span>
                `;

                downloadButtonsContainer.appendChild(button);
            });

            if (hasDownloads) {
                downloadSection.classList.remove('d-none');
                downloadSectionHint.textContent = p.is_purchased
                    ? 'Pembayaran untuk produk ini sudah selesai. Anda bisa langsung mengunduh file aset.'
                    : (p.is_logged_in
                        ? 'Klik tombol aset untuk membuka checkout Midtrans sebelum download dimulai.'
                        : 'Klik tombol aset untuk login terlebih dahulu, lalu lanjutkan ke pembayaran Midtrans.');
            } else {
                downloadSection.classList.add('d-none');
            }

            // Spatial link
            const spatialWrap = document.getElementById('modalSpatialWrap');
            if (p.spatial_link) {
                document.getElementById('modalSpatialLink').href = p.spatial_link;
                spatialWrap.classList.remove('d-none');
            } else {
                spatialWrap.classList.add('d-none');
            }

            // â”€â”€ VIEWER â”€â”€
            const wrap = document.getElementById('viewerWrap');
            wrap.innerHTML = ''; // reset

            const hint = document.getElementById('modalViewerHint');

            if (p.model_path && p.model_ext === 'glb') {
                // âœ… GLB â†’ model-viewer interaktif
                const mv = document.createElement('model-viewer');
                mv.setAttribute('src', p.model_path);
                mv.setAttribute('alt', p.title);
                mv.setAttribute('camera-controls', '');
                mv.setAttribute('auto-rotate', '');
                mv.setAttribute('shadow-intensity', '1');
                mv.setAttribute('exposure', '0.8');
                mv.setAttribute('ar', '');
                mv.setAttribute('ar-modes', 'webxr scene-viewer quick-look');
                mv.style.width  = '100%';
                mv.style.height = '420px';
                mv.style.background = 'transparent';

                // loading poster = gambar produk jika ada
                if (p.image) mv.setAttribute('poster', p.image);

                const badge = document.createElement('div');
                badge.className = 'model-badge';
                badge.innerHTML = 'ðŸ”„ Drag untuk memutar &nbsp;Â·&nbsp; Scroll untuk zoom';
                mv.appendChild(badge);

                wrap.appendChild(mv);
                hint.textContent = 'Model 3D interaktif â€” gunakan mouse/sentuh untuk memutar & zoom.';

            } else if (p.model_path && p.model_ext === 'fbx') {
                // FBX â†’ tampilkan info + link download karena browser tidak support FBX native
                wrap.innerHTML = `
                    <div class="viewer-no-model text-center text-white w-100" style="padding:60px 40px;">
                        <div style="font-size:72px;margin-bottom:16px;">ðŸ“¦</div>
                        <h5 style="font-weight:700;margin-bottom:8px;">File FBX Tersedia</h5>
                        <p style="opacity:.7;font-size:13px;max-width:340px;margin:0 auto 20px;">
                            Format FBX tidak dapat diputar langsung di browser.<br>
                            Gunakan software 3D seperti Blender, Maya, atau 3ds Max.
                        </p>
                        <a href="${p.model_path}" download class="btn btn-outline-light btn-sm">
                            â¬‡ï¸ Download File FBX
                        </a>
                    </div>`;
                hint.textContent = 'File FBX tidak dapat dirender langsung di browser.';

            } else if (p.image) {
                // Tidak ada model â†’ tampilkan gambar
                wrap.innerHTML = `<img src="${p.image}" alt="${p.title}"
                    style="width:100%;height:420px;object-fit:contain;background:#111;">`;
                hint.textContent = 'Produk ini belum memiliki model 3D.';

            } else {
                wrap.innerHTML = `
                    <div class="viewer-no-model w-100">
                        <span style="font-size:72px;display:block;margin-bottom:12px;text-align:center;">ðŸ§Š</span>
                        <p style="text-align:center;color:#aab;">Tidak ada gambar maupun model 3D.</p>
                    </div>`;
                hint.textContent = '';
            }

            productModal.show();
        }

        // Bersihkan model-viewer saat modal ditutup agar tidak buang resource
        document.getElementById('productModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('viewerWrap').innerHTML = '';
            document.getElementById('modalViewerHint').textContent = '';
        });
    </script>
</body>
</html>

