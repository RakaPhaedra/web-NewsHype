@extends('layouts.app')

@section('title', 'Buat Berita Baru - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Berita Baru</h1>
    <a href="{{ route('berita.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Berita</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="judul">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" name="judul" value="{{ old('judul') }}" required 
                               placeholder="Masukkan judul berita yang menarik...">
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" 
                                id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gambar">Foto Berita</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" 
                                   id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                            <label class="custom-file-label" for="gambar">Pilih foto...</label>
                        </div>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Format: JPG, PNG, GIF. Maksimal 2MB. Foto akan ditampilkan di daftar berita.
                        </small>
                        @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Preview Image -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="preview" src="/placeholder.svg" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="konten">Konten Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" 
                                  id="konten" name="konten" rows="12" required 
                                  placeholder="Tulis konten berita di sini...">{{ old('konten') }}</textarea>
                        @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-lightbulb"></i> Tips: Mulai dengan lead yang menarik, gunakan paragraf pendek, dan sertakan fakta yang akurat.
                        </small>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Simpan sebagai Draft
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('konten', {
        height: 300,
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
            { name: 'styles', items: ['Format'] },
            { name: 'tools', items: ['Maximize'] }
        ]
    });

    // Preview image function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
            
            // Update label
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerHTML = fileName;
        }
    }

    // Auto-generate slug from title (optional)
    document.getElementById('judul').addEventListener('input', function() {
        // You can add slug generation logic here if needed
    });
</script>
@endpush
