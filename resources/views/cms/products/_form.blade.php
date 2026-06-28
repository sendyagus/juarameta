<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Nama Produk</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $product->title ?? '') }}" required
                placeholder="Contoh: Metaschool Main Building">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                placeholder="Deskripsi singkat produk...">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" min="0" class="form-control" id="price" name="price"
                    value="{{ old('price', $product->price ?? 0) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="author" class="form-label fw-semibold">Author</label>
                <input type="text" class="form-control" id="author" name="author"
                    value="{{ old('author', $product->author ?? 'JuaraMeta') }}"
                    placeholder="Contoh: JuaraMeta">
            </div>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-semibold">Kategori</label>
            <select name="category_id" id="category" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="is_hot" name="is_hot"
                value="1" {{ old('is_hot', $product->is_hot ?? false) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_hot">Tandai sebagai produk HOT</label>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-semibold">Gambar</label>
            <input class="form-control" type="file" id="image" name="image">
            @if (!empty($product->image))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Preview" class="rounded shadow-sm"
                        style="width: 150px; height: auto;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="model_path" class="form-label fw-semibold">Upload Model 3D (Aset 1 - Preview)</label>
            <input class="form-control" type="file" id="model_path" name="model_path" accept=".glb,.fbx">
            <div class="form-text">
                <i class="bx bx-info-circle"></i>
                Format yang diterima: <strong>.glb</strong> dan <strong>.fbx</strong> &mdash; Ukuran maksimal: <strong>40 MB</strong> (Akan digunakan untuk render preview 3D)
            </div>

            @if (!empty($product->model_path))
                <div class="mt-2 d-flex align-items-center gap-2">
                    <i class="bx bx-cube text-primary fs-5"></i>
                    <small class="text-muted">File ter-upload: <strong>{{ basename($product->model_path) }}</strong></small>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="model_path_2" class="form-label fw-semibold">Upload Aset Tambahan (Aset 2 - Pilihan Download Lainnya)</label>
            <input class="form-control" type="file" id="model_path_2" name="model_path_2" accept=".glb,.fbx,.blend,.obj,.max,.zip,.rar">
            <div class="form-text">
                <i class="bx bx-info-circle"></i>
                Format yang diterima: <strong>.glb, .fbx, .blend, .obj, .max, .zip, .rar</strong> &mdash; Ukuran maksimal: <strong>40 MB</strong>
            </div>

            @if (!empty($product->model_path_2))
                <div class="mt-2 d-flex align-items-center gap-2">
                    <i class="bx bx-file text-success fs-5"></i>
                    <small class="text-muted">File ter-upload: <strong>{{ basename($product->model_path_2) }}</strong></small>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="spatial_link" class="form-label fw-semibold">Link Spatial</label>
            <input type="url" class="form-control" id="spatial_link" name="spatial_link"
                placeholder="https://www.spatial.io/..."
                value="{{ old('spatial_link', $product->spatial_link ?? '') }}">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-danger">
                <i class="bx bx-save"></i> {{ $buttonText ?? 'Simpan' }}
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Batal
            </a>
        </div>
    </div>
</div>
