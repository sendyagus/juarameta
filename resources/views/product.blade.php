<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>JUARAMETA - Product</title>
    <meta name="description" content="Koleksi 3D Model eksklusif berkualitas tinggi dari JuaraMeta untuk metaverse dan simulasi." />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo-Meta.png') }}" />
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6f8;
            color: #2d3340;
        }

        /* ── HEADER ── */
        .product-header {
            background: #fff;
            border-bottom: 1px solid #e9edf3;
            padding: 12px 0;
        }
        .product-logo { max-height: 54px; }
        .product-nav a {
            font-size: 14px;
            color: #525f75;
            text-decoration: none;
            margin-left: 22px;
        }
        .product-nav a.active { color: #e03333; font-weight: 600; }

        /* ── LAYOUT ── */
        .product-wrapper { padding: 44px 0 70px; }
        .section-title {
            color: #e03333;
            font-size: 44px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 34px;
        }
        .section-title span { border-bottom: 4px solid #e03333; padding-bottom: 5px; }

        /* ── INTRO BOX ── */
        .intro-box {
            border-radius: 14px;
            background: linear-gradient(130deg, #d7ebfc 0%, #c7e3fb 55%, #b9dcfb 100%);
            padding: 34px 30px;
            min-height: 235px;
        }
        .intro-box h2 { font-size: 42px; font-weight: 700; margin-bottom: 14px; }
        .intro-box h2 .brand { color: #10a2e9; }
        .intro-box p { color: #4a596f; max-width: 86%; margin-bottom: 24px; }
        .btn-collection {
            background: #0ba0df;
            border: 0;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            padding: 10px 22px;
            text-decoration: none;
            display: inline-block;
        }

        /* ── HIGHLIGHT CARD ── */
        .highlight-card {
            background: #fff;
            border: 1px solid #e4e8ee;
            border-radius: 12px;
            padding: 14px;
            min-height: 235px;
        }
        .highlight-thumb {
            height: 110px;
            border-radius: 8px;
            background: #ebedf1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b1b8c4;
            font-size: 14px;
            overflow: hidden;
        }
        .tag-hot {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 5px;
            background: #ff4f55;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .highlight-title { font-size: 24px; margin: 14px 0 22px; font-weight: 700; }
        .highlight-meta { color: #8a95a8; font-size: 13px; }
        .highlight-price { color: #0dbf5f; font-size: 30px; font-weight: 700; text-align: right; }

        /* ── TOOLBAR ── */
        .toolbar { margin: 28px 0 24px; display: flex; gap: 14px; }
        .filter-select { max-width: 190px; border-radius: 10px; border: 1px solid #dce3ed; height: 48px; }
        .search-box { border-radius: 26px; border: 1px solid #dce3ed; height: 48px; }

        /* ── PRODUCT CARD ── */
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

        /* ── MODAL ── */
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
    </style>
</head>

<body>
    <header class="product-header">
        <div class="container d-flex align-items-center justify-content-between">
            <img src="{{ asset('assets/img/Logo-Meta.png') }}" alt="JuaraMeta" class="product-logo">
            <nav class="product-nav d-none d-md-block">
                <a href="{{ route('home') }}#hero">Home</a>
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('home') }}#gallery">Project</a>
                <a href="{{ route('home') }}#faqs">FAQs</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                <a href="{{ route('product') }}" class="active">Product</a>
            </nav>
        </div>
    </header>

    <main class="product-wrapper">
        <div class="container">
            <h1 class="section-title"><span>Our Product</span></h1>

            {{-- === INTRO & FEATURED === --}}
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="intro-box">
                        <h2>Selamat Datang di <span class="brand">JuaraMeta Assets</span></h2>
                        <p>Temukan berbagai koleksi 3D Model eksklusif berkualitas tinggi. Dirancang khusus untuk
                            mempercepat proses pengembangan dunia metaverse dan simulasi Anda.</p>
                        <a href="#product-grid" class="btn-collection">Jelajahi Koleksi</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="highlight-card">
                        @if ($featuredProject)
                            @if ($featuredProject->is_hot)
                                <span class="tag-hot">HOT</span>
                            @endif
                            <div class="highlight-thumb">
                                @if ($featuredProject->image)
                                    <img src="{{ asset('storage/' . $featuredProject->image) }}"
                                        alt="{{ $featuredProject->title }}"
                                        style="max-width:100%;max-height:100%;object-fit:cover;">
                                @else
                                    Thumbnail 3D Model
                                @endif
                            </div>
                            <div class="highlight-title">{{ $featuredProject->title }}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="highlight-meta">{{ optional($featuredProject->category)->name ?: 'Asset Pack' }}</div>
                                <div class="highlight-price">Rp {{ number_format($featuredProject->price ?? 0, 0, ',', '.') }}</div>
                            </div>
                        @else
                            <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                Belum ada produk unggulan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

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

                                <div id="modalSpatialWrap" class="mt-3 d-none">
                                    <a id="modalSpatialLink" href="#" target="_blank" class="spatial-btn">
                                        🌐 Buka di Spatial.io
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
        /* ── FILTER & SEARCH ── */
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

        /* ── MODAL ── */
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));

        function formatRupiah(n) {
            return 'Rp ' + Number(n).toLocaleString('id-ID');
        }

        function openProductModal(p) {
            // Header title
            document.getElementById('modalProductTitle').textContent = p.title;

            // Badges
            let badges = `<span class="detail-badge">${p.category}</span>`;
            if (p.is_hot) badges += ` <span class="detail-badge hot">🔥 HOT</span>`;
            document.getElementById('modalBadges').innerHTML = badges;

            // Info
            document.getElementById('modalTitle').textContent    = p.title;
            document.getElementById('modalDesc').textContent     = p.description || 'Tidak ada deskripsi.';
            document.getElementById('modalCategory').textContent = p.category;
            document.getElementById('modalAuthor').textContent   = p.author;
            document.getElementById('modalPrice').textContent    = formatRupiah(p.price);

            // Format badge
            const fmtEl = document.getElementById('modalFormat');
            if (p.model_ext) {
                fmtEl.innerHTML = `<span style="font-weight:700;font-size:13px;color:#2b69f0;">.${p.model_ext.toUpperCase()}</span>`;
            } else {
                fmtEl.textContent = 'Tidak ada model 3D';
            }

            // Spatial link
            const spatialWrap = document.getElementById('modalSpatialWrap');
            if (p.spatial_link) {
                document.getElementById('modalSpatialLink').href = p.spatial_link;
                spatialWrap.classList.remove('d-none');
            } else {
                spatialWrap.classList.add('d-none');
            }

            // ── VIEWER ──
            const wrap = document.getElementById('viewerWrap');
            wrap.innerHTML = ''; // reset

            const hint = document.getElementById('modalViewerHint');

            if (p.model_path && p.model_ext === 'glb') {
                // ✅ GLB → model-viewer interaktif
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
                badge.innerHTML = '🔄 Drag untuk memutar &nbsp;·&nbsp; Scroll untuk zoom';
                mv.appendChild(badge);

                wrap.appendChild(mv);
                hint.textContent = 'Model 3D interaktif — gunakan mouse/sentuh untuk memutar & zoom.';

            } else if (p.model_path && p.model_ext === 'fbx') {
                // FBX → tampilkan info + link download karena browser tidak support FBX native
                wrap.innerHTML = `
                    <div class="viewer-no-model text-center text-white w-100" style="padding:60px 40px;">
                        <div style="font-size:72px;margin-bottom:16px;">📦</div>
                        <h5 style="font-weight:700;margin-bottom:8px;">File FBX Tersedia</h5>
                        <p style="opacity:.7;font-size:13px;max-width:340px;margin:0 auto 20px;">
                            Format FBX tidak dapat diputar langsung di browser.<br>
                            Gunakan software 3D seperti Blender, Maya, atau 3ds Max.
                        </p>
                        <a href="${p.model_path}" download class="btn btn-outline-light btn-sm">
                            ⬇️ Download File FBX
                        </a>
                    </div>`;
                hint.textContent = 'File FBX tidak dapat dirender langsung di browser.';

            } else if (p.image) {
                // Tidak ada model → tampilkan gambar
                wrap.innerHTML = `<img src="${p.image}" alt="${p.title}"
                    style="width:100%;height:420px;object-fit:contain;background:#111;">`;
                hint.textContent = 'Produk ini belum memiliki model 3D.';

            } else {
                wrap.innerHTML = `
                    <div class="viewer-no-model w-100">
                        <span style="font-size:72px;display:block;margin-bottom:12px;text-align:center;">🧊</span>
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
