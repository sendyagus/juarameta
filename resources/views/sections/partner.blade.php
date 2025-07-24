<!-- ======= Logo Carousel Marquee ======= -->
<section class="logo-carousel-section py-4 " data-aos="fade-up">
    <div class="section-title">
        <h2 class="fw-bold">Our Partner</h2>
        {{-- <p class="text-muted">Jelajahi berbagai ruang virtual yang kami hadirkan</p> --}}
    </div>

    <!-- Baris 1 -->
    <div class="marquee-row marquee-row-1">
        <div class="marquee-content">
            @foreach($partners as $partner)
                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}">
            @endforeach
        </div>
    </div>

    <!-- Baris 2 (reverse arah) -->
    <div class="marquee-row marquee-row-2">
        <div class="marquee-content reverse">
            @foreach(array_reverse($partners->toArray()) as $partner)
                <img src="{{ asset('storage/' . $partner['logo']) }}" alt="{{ $partner['name'] }}">
            @endforeach
        </div>
    </div>
</section>
