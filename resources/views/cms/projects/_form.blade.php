<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">📌 Judul Project</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ old('title', $project->title ?? '') }}" required
                   placeholder="Contoh: MetaTekno">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">📝 Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      placeholder="Deskripsi singkat proyek...">{{ old('description', $project->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-semibold">🏷️ Kategori</label>
            <select name="category_id" id="category" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ (old('category_id', $project->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-semibold">🖼️ Gambar</label>
            <input class="form-control" type="file" id="image" name="image">
            @if (!empty($project->image))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Preview" class="rounded shadow-sm"
                         style="width: 150px; height: auto;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="model_path" class="form-label fw-semibold">🎮 Upload Model 3D (GLB) <span class="text-danger">*Opsional</span> </label>
            <input class="form-control" type="file" id="model_path" name="model_path" accept=".glb">
        
            @if (!empty($project->model_path))
                <div class="mt-2">
                    <small>Model ter-upload: {{ basename($project->model_path) }}</small>
                </div>
            @endif
        </div>
        

        <div class="mb-3">
            <label for="spatial_link" class="form-label fw-semibold">🌐 Link Spatial</label>
            <input type="url" class="form-control" id="spatial_link" name="spatial_link"
                   placeholder="https://www.spatial.io/..."
                   value="{{ old('spatial_link', $project->spatial_link ?? '') }}">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-danger">
                <i class="bx bx-save"></i> {{ $buttonText ?? 'Simpan' }}
            </button>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Batal
            </a>
        </div>
    </div>
</div>
