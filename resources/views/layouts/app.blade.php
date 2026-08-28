<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>JUARAMETA</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo-Meta.png') }}" />
    <link href="{{ asset('assets/img/Logo-Meta.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />
    <script src="https://unpkg.com/matches-selector@2/matches-selector.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

    <style>
        /* Gallery Filter Pills */
        #gallery-filters .nav-link {
            border-radius: 30px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #10b1e9;
            background-color: transparent;
        }

        #gallery-filters .nav-link.active,
        #gallery-filters .nav-link:hover {
            color: #fff;
            background-color: #10b1e9;
        }

        .gallery-item {
            display: none;
            /* Default hidden */
        }

        .gallery-item.visible {
            display: block;
            /* Only show those with 'visible' */
        }

        /* Card UI Improvement */
        .gallery-item .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .gallery-item .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3);
        }

        .gallery-item .card-img-top {
            transition: transform 0.3s ease;
            height: 200px;
            object-fit: cover;
            object-position: center;
        }

        .gallery-item .card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Tombol dalam Card */
        .gallery-item .btn {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .gallery-item .btn-danger {
            background-color: #10b1e9;
            border-color: #10b1e9;
        }

        .gallery-item .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Card Title */
        .gallery-item .card-title {
            font-weight: 700;
            color: #10b1e9;
            margin-bottom: 5px;
        }

        .gallery-item .card-text {
            font-size: 14px;
            color: #10b1e9;
        }

        .gallery-img {
            position: relative;
            overflow: hidden;
        }

        .gallery-img:hover .view-btn {
            display: block;
        }

        #modelPopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            position: relative;
            /* Diperlukan untuk menempatkan tombol close secara absolut */
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 90%;
            max-height: 90%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        canvas#popup-canvas {
            width: 600px;
            height: 400px;
            background: #ffffff;
            margin-bottom: 15px;
        }

        #popup-info {
            text-align: center;
            margin-bottom: 10px;
        }

        /* Tombol close jadi icon X */
        #closePopup {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 36px;
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            z-index: 10;
        }

        #closePopup:hover {
            color: #10b1e9;
        }


        /* Contact */
        .social-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
            opacity: 0.85;
        }

        .social-icon.instagram {
            color: #E1306C;
        }

        .social-icon.tiktok {
            color: #000000;
        }

        .social-icon.facebook {
            color: #1877F2;
        }

        .social-icon.youtube {
            color: #FF0000;
        }

        @media (max-width: 576px) {
            .fs-3 {
                font-size: 1.8rem !important;
            }

            .social-icon {
                margin: 0 0.75rem;
            }
        }

        /* ===== Carousel Section Style ===== */
.text-carousel-section,
.text-carousel-section-left {
    overflow: hidden;
    position: relative;
    padding: 12px 0;
}

.text-carousel-section {
    background: linear-gradient(to right, #ffffff, #ffd2d2);
}

.text-carousel-section-left {
    background: linear-gradient(to left, #ffffff, #ffd2d2);
}

/* ===== Marquee Text Style ===== */
.marquee-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.marquee-content {
    display: inline-block;
    white-space: nowrap;
    padding-left: 100%;
    animation: marquee-left 25s linear infinite;
    font-size: 1.25rem;
    font-weight: 600;
    color: #e9003d;
}

.marquee-content.reverse {
    animation: marquee-right 25s linear infinite;
}

@keyframes marquee-left {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-100%);
    }
}

@keyframes marquee-right {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(0%);
    }
}

/* ===== Logo Carousel Section Style ===== */
.logo-carousel-section {
    overflow: hidden;
    background: #fff;
}

.marquee-row {
    white-space: nowrap;
    display: flex;
    align-items: center;
    height: 200px;
}

.marquee-content img {
    height: 120px;
    margin: 40px 30px;
}

/* ===== Jika Tidak Ada Data ===== */
.no-items-container {
    min-height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #777;
    font-size: 1.1rem;
}

/* ===== RESPONSIVE ADJUSTMENTS ===== */
@media (max-width: 768px) {
    .marquee-content {
        font-size: 0.9rem;
        animation-duration: 35s; /* perpanjang waktu agar mudah dibaca */
    }

    .marquee-content img {
        height: 80px;
        margin: 20px 15px;
    }

    .marquee-row {
        height: 150px;
    }

    .no-items-container {
        font-size: 1rem;
        padding: 20px;
    }

    .text-carousel-section,
    .text-carousel-section-left {
        padding: 8px 0;
    }
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
    /* padding: 6px 12px 6px 6px;    */
    border: 1px solid rgba(255, 255, 255, 1);
    border-radius: 999px;
    /* background: rgba(255, 255, 255, .92); */
    /* box-shadow: 0 10px 24px rgba(14, 36, 66, .1); */
    color: #000;
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

<style>
    #workspace-wrapper {
        position: relative;
        height: 500px;
        overflow: hidden;
        padding: 20px;
        border-radius: 16px;
        scroll-behavior: smooth;
        outline: none;
    }

    .workspace-slide {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        opacity: 0;
        transform: translateX(-40px);
        transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 500px;
    }

    .workspace-slide.active {
        opacity: 1;
        transform: translateX(0);
    }

    .workspace-content {
        flex: 1 1 50%;
        padding: 60px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        animation: fadeSlideInLeft 0.8s ease forwards;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 320px;
        gap: 1.2rem;
    }

    .workspace-content h4 {
        font-size: 2.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #da1437;
        position: relative;
        padding-bottom: 8px;
        max-width: fit-content;
        cursor: default;
    }

    .workspace-content h4::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #4a90e2, #50e3c2);
        border-radius: 2px;
        animation: underlineSlide 1.2s ease forwards;
    }

    @keyframes underlineSlide {
        0% {
            width: 0;
        }
        100% {
            width: 60px;
        }
    }

    .workspace-content p {
        font-size: 2.1rem;
        line-height: 1.6;
        color: #555;
        flex-grow: 1;
    }

    .workspace-content p:last-child {
        font-style: italic;
        color: #888;
        font-size: 1.2rem;
        margin-top: 0;
    }

    .workspace-img {
        flex: 1 1 50%;
        text-align: center;
        animation: fadeSlideInRight 0.8s ease forwards;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 320px;
        padding: 0 40px 0 0;
    }

    .workspace-img img {
        max-width: 100%;
        height: auto;
        border-radius: 24px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15), inset 0 0 15px rgba(74, 144, 226, 0.3);
        transition: transform 0.5s ease, box-shadow 0.5s ease;
        cursor: pointer;
        border: 4px solid transparent;
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

    .workspace-img img:hover {
        transform: scale(1.1) rotate(1deg);
        box-shadow: 0 20px 40px rgba(74, 144, 226, 0.4), inset 0 0 20px rgba(80, 227, 194, 0.5);
        border-color: transparent;
    }

    .slide-indicator {
        text-align: center;
    }

    .slide-indicator .dot {
        display: inline-block;
        width: 14px;
        height: 14px;
        margin: 0 6px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .slide-indicator .dot.active {
        background-color: #4a90e2;
        box-shadow: 0 0 6px #4a90e2;
    }

    @keyframes fadeSlideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-40px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeSlideInRight {
        0% {
            opacity: 0;
            transform: translateX(40px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        #workspace-wrapper {
            height: auto;
            padding: 16px;
        }

        .workspace-slide {
            flex-direction: column;
            min-height: auto;
            height: auto;
        }

        .workspace-content,
        .workspace-img {
            flex: 1 1 100%;
            padding: 20px;
            height: auto;
        }

        .workspace-content h4 {
            font-size: 1.6rem;
        }

        .workspace-content p {
            font-size: 1.1rem;
        }

        .workspace-content p:last-child {
            font-size: 1rem;
        }

        .workspace-img {
            padding: 0;
            margin-top: 1rem;
        }

        .workspace-img img {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 16px;
        }
    }
</style>


</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex align-items-center  px-5">
            <h1 class="logo me-auto">
                <a href="index.html"><img style="max-height: 60px" src="assets/img/Logo-Meta.png" alt="" /></a>
            </h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#gallery">Project</a></li>
                    <li><a class="nav-link scrollto" href="#faqs">FaQs</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link" href="{{ route('product') }}">Product</a></li>
                </ul>

                <div class="navbar-auth">
                    @guest
                        <a href="{{ route('login') }}" class="navbar-login-btn" id="navbar-login-btn">Login</a>
                    @else
                        <div class="navbar-user-menu" id="navbar-user-menu">
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

                            <div class="navbar-user-dropdown" id="navbar-user-dropdown">
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
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <main class="py-4">
        @yield('content')
    </main>

    </div>
    <footer class="bg-dark text-light">
        <div class="container py-5">
            <div class="row">
                <div class="text-center small text-muted">
                    &copy; 2025 JuaraMeta. All rights reserved.
                </div>
            </div>
    </footer>

    <div id="modelPopup"
        style="
        display: none; 
        position: fixed; 
        top: 0; left: 0; 
        width: 100%; height: 100%; 
        background: rgba(0, 0, 0, 0.7); 
        justify-content: center; 
        align-items: center; 
        z-index: 9999;
        backdrop-filter: blur(5px);
        transition: opacity 0.3s ease;
      ">
        <div
            style="
          background: #fff; 
          border-radius: 15px; 
          padding: 30px 20px 25px; 
          position: relative; 
          width: 95%; 
          max-width: 900px;
          box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
          transform: scale(1);
          transition: transform 0.3s ease;
          overflow: hidden;
        ">
            <!-- Close Button -->
            <button id="closePopup"
                style="
            position: absolute; 
            top: 15px; 
            right: 15px; 
            background: #10b1e9; 
            border-color: #10b1e9; 
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 14px; 
            color: #fff; 
            cursor: pointer;
          ">
                x
            </button>

            <!-- Title -->
            <h3 id="popup-title" style="margin-top: 10px; font-size: 24px; color: #222;"></h3>

            <!-- Description -->
            <p id="popup-description" style="color: #555; margin-bottom: 20px;"></p>

            <!-- 3D Canvas -->
            <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                <canvas id="popup-canvas" style="width:100%; height:400px;"></canvas>
            </div>

            <!-- Link Button -->
            <div style="text-align: right; margin-top: 25px;">
                <a id="popup-link" href="#" target="_blank"
                    style=" color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; transition: background 0.3s;">
                    ðŸ”— View in Spatial
                </a>
            </div>
        </div>
    </div>
    </main>
    <!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <!-- Include AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        function showPopup(modelPath, title, description, link) {
            document.getElementById("modelPopup").style.display = "flex";
            document.getElementById("popup-title").innerText = title;
            document.getElementById("popup-description").innerText = description;
            document.getElementById("popup-link").href = link;

            const canvas = document.getElementById("popup-canvas");
            canvas.innerHTML = ""; // Tidak berlaku untuk canvas, abaikan atau reset dengan ukuran

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(
                75,
                canvas.clientWidth / canvas.clientHeight,
                0.1,
                1000
            );
            const renderer = new THREE.WebGLRenderer({
                canvas: canvas,
                alpha: true,
                antialias: true,
            });
            renderer.setSize(canvas.clientWidth, canvas.clientHeight);
            renderer.setPixelRatio(window.devicePixelRatio);

            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;

            const light = new THREE.AmbientLight(0xffffff, 0.8);
            scene.add(light);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 5, 5);

            const pointLight = new THREE.PointLight(0x00bfff, 1, 100);
            pointLight.position.set(-5, 2, 5);

            scene.add(directionalLight);

            const loader = new THREE.GLTFLoader();
            loader.load(
                modelPath,
                function(gltf) {
                    const model = gltf.scene;
                    scene.add(model);
                    animate();
                },
                undefined,
                function(error) {
                    console.error("Model load error:", error);
                }
            );

            camera.position.z = 2;

            function animate() {
                requestAnimationFrame(animate);
                controls.update();
                renderer.render(scene, camera);
            }
        }

        document.querySelectorAll(".view-btn").forEach((button) => {
            button.addEventListener("click", function() {
                const model = this.getAttribute("data-model");
                const title = this.getAttribute("data-title");
                const description = this.getAttribute("data-description");
                const link = this.getAttribute("data-link");
                showPopup(model, title, description, link);
            });
        });

        document
            .getElementById("closePopup")
            .addEventListener("click", function() {
                document.getElementById("modelPopup").style.display = "none";
            });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var iso = new Isotope('.gallery-container', {
                itemSelector: '.gallery-item',
                layoutMode: 'fitRows',
            });

            const allItems = document.querySelectorAll('.gallery-item');
            const filtersElem = document.querySelector('#gallery-filters');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const searchInput = document.getElementById('searchInput');

            let activeFilter = '*';
            let visibleCount = 6;
            let allVisible = false;

            function getFilteredItems() {
                return Array.from(allItems).filter(item => {
                    return activeFilter === '*' || item.classList.contains(activeFilter.substring(1));
                });
            }

            function applySearchFilter(items) {
                const query = searchInput.value.toLowerCase();
                return items.filter(item => {
                    const title = item.querySelector('.card-title')?.textContent.toLowerCase() || '';
                    return title.includes(query);
                });
            }

            function showItems() {
                allItems.forEach(item => item.classList.remove('visible'));

                let itemsToShow = getFilteredItems();
                itemsToShow = applySearchFilter(itemsToShow);

                itemsToShow.forEach((item, index) => {
                    if (index < visibleCount) {
                        item.classList.add('visible');
                    }
                });

                iso.arrange({
                    filter: '.visible'
                });

                // Show/hide load more button
                if (itemsToShow.length <= 6) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'inline-block';
                }

                // Show/hide 'no items' message
                const noItemsMessage = document.getElementById('noItemsMessage');
                if (itemsToShow.length === 0) {
                    noItemsMessage.style.display = 'block';
                } else {
                    noItemsMessage.style.display = 'none';
                }

                const noItemsWrapper = document.getElementById('noItemsWrapper');

                if (itemsToShow.length === 0) {
                    noItemsWrapper.style.display = 'flex';
                } else {
                    noItemsWrapper.style.display = 'none';
                }

            }


            filtersElem.addEventListener('click', function(event) {
                if (!event.target.matches('button')) return;

                filtersElem.querySelectorAll('.nav-link').forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');

                activeFilter = event.target.getAttribute('data-filter');
                visibleCount = 6;
                allVisible = false;
                loadMoreBtn.innerText = "Tampilkan Lebih Banyak";

                showItems();
            });

            loadMoreBtn.addEventListener('click', function() {
                const filteredItems = applySearchFilter(getFilteredItems());

                if (!allVisible) {
                    visibleCount = filteredItems.length;
                    allVisible = true;
                    loadMoreBtn.innerText = "Tampilkan Lebih Sedikit";
                } else {
                    visibleCount = 6;
                    allVisible = false;
                    loadMoreBtn.innerText = "Tampilkan Lebih Banyak";

                    const section = document.getElementById("gallery");
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }

                showItems();
            });

            searchInput.addEventListener('input', () => {
                visibleCount = 6;
                allVisible = false;
                loadMoreBtn.innerText = "Tampilkan Lebih Banyak";
                showItems();
            });

            showItems(); // Initial render
        });
    </script>

    <script>
        const phrases = [
            "ðŸš€ Menjelajah Dunia Metaverse",
            "ðŸŒ Transformasi Digital Kampus",
            "ðŸŽ“ Edukasi Virtual Imersif",
            "ðŸ’¡ Kolaborasi di Era 3D",
            "ðŸ“¡ Masa Depan Dimulai di Sini"
        ];

        let index = 0;
        const el = document.getElementById("metaverse-carousel");

        function showNextPhrase() {
            el.textContent = phrases[index];
            index = (index + 1) % phrases.length;
        }

        showNextPhrase();
        setInterval(showNextPhrase, 3000); // Ganti setiap 3 detik
    </script>

    <script>
        const slidesData = @json($slidesData);

        const wrapper = document.getElementById('workspace-wrapper');
        const indicator = document.getElementById('slide-indicator');
        let currentIndex = 0;
        let isThrottled = false;

        function createIndicator() {
            indicator.innerHTML = '';
            slidesData.forEach((_, i) => {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                if (i === currentIndex) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    if (i !== currentIndex) {
                        currentIndex = i;
                        renderSlide(currentIndex);
                    }
                });
                indicator.appendChild(dot);
            });
        }

        function updateIndicator() {
            const dots = indicator.querySelectorAll('.dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function renderSlide(index) {
            const data = slidesData[index];
            wrapper.innerHTML = `
              <div class="workspace-slide active" tabindex="0">
                <div class="workspace-content">
                  <h4>${data.title}</h4>
                  <p>${data.desc}</p>
                </div>
                <div class="workspace-img">
                  <img src="${data.img}" alt="${data.title}" class="workspace-img-hover">
                </div>
              </div>
            `;
            wrapper.scrollTop = 0; // reset scroll saat slide baru
            updateIndicator();
            wrapper.focus();
        }


        renderSlide(currentIndex);
        createIndicator();

        // Fungsi throttle untuk delay antar scroll ganti slide
        function throttleScroll() {
            isThrottled = true;
            setTimeout(() => {
                isThrottled = false;
            }, 800);
        }

        setInterval(() => {
            currentIndex = (currentIndex + 1) % slidesData.length;
            renderSlide(currentIndex);
        }, 5000); // auto change every 6s
    </script>
</body>

</html>

