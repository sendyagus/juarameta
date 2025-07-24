<section id="gallery" class="gallery bg-light py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2 class="fw-bold">Our Project</h2>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 offset-md-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan judul...">
            </div>
        </div>

        <!-- Filter Tabs -->
        <ul class="nav nav-pills justify-content-center mb-4" id="gallery-filters">
            <li class="nav-item"><button class="nav-link active text-white bg-danger" data-filter="*">All</button></li>
            @foreach ($categories as $category)
                <li class="nav-item">
                    <button class="nav-link" data-filter=".{{ str_replace(' ', '', $category->name) }}">
                        {{ $category->name }}
                    </button>
                </li>
            @endforeach

        </ul>

        <!-- Gallery Items -->
        <div class="row gallery-container g-4" data-aos="fade-up" data-aos-delay="100">
            @forelse ($projects as $project)
                <div class="col-lg-4 col-md-6 gallery-item {{ str_replace(' ', '',  $project->category->name) }}">
                    <div class="card border-0 shadow h-100">
                        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top"
                            alt="{{ $project->title }}" />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text text-muted">{{ $project->description }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                                <button class="btn btn-outline-secondary btn-sm view-btn"
                                    @if (empty($project->model_path)) disabled
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Model 3D belum tersedia"
                                    @else
                                        data-model="{{ Storage::url($project->model_path) }}" @endif
                                    data-title="{{ $project->title }}" data-description="{{ $project->description }}"
                                    data-link="{{ $project->spatial_link }}">
                                    <i class="bx bx-plus me-1"></i> 3D Preview
                                </button>
                                <a href="{{ $project->spatial_link }}" target="_blank" class="btn btn-danger btn-sm">
                                    View in Spatial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada project tersedia.</div>
            @endforelse
        </div>

        <div id="noItemsWrapper" style="display: none;" class="no-items-container">
            <p id="noItemsMessage">Belum ada space</p>
        </div>

        <div class="text-center mt-4">
            <button id="loadMoreBtn" class="btn btn-outline-danger">Tampilkan Lebih Banyak</button>
        </div>
    </div>
</section>
