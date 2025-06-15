@extends('layouts.app')

@section('title', 'Tambah Kategori - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Baru</h1>
    <a href="{{ route('kategori.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kategori</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required 
                               placeholder="Contoh: Politik, Ekonomi, Olahraga...">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Nama kategori harus unik dan akan otomatis dibuatkan slug
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" 
                                  placeholder="Deskripsi singkat tentang kategori ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-lightbulb"></i> Opsional: Jelaskan jenis berita apa yang masuk dalam kategori ini
                        </small>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Simpan Kategori
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tips Kategori</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        <strong>Nama yang jelas:</strong> Gunakan nama yang mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        <strong>Unik:</strong> Pastikan nama kategori belum ada
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        <strong>Deskripsi:</strong> Bantu wartawan memilih kategori yang tepat
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        <strong>Konsisten:</strong> Gunakan penamaan yang konsisten
                    </li>
                </ul>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contoh Kategori</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <span class="badge badge-primary mb-1">Politik</span><br>
                        <span class="badge badge-success mb-1">Ekonomi</span><br>
                        <span class="badge badge-info mb-1">Teknologi</span><br>
                        <span class="badge badge-warning mb-1">Olahraga</span>
                    </div>
                    <div class="col-6">
                        <span class="badge badge-danger mb-1">Hiburan</span><br>
                        <span class="badge badge-dark mb-1">Kesehatan</span><br>
                        <span class="badge badge-secondary mb-1">Pendidikan</span><br>
                        <span class="badge badge-light mb-1">Internasional</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug preview (optional)
    document.getElementById('nama').addEventListener('input', function() {
        const nama = this.value;
        const slug = nama.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim('-'); // Remove leading/trailing hyphens
        
        // You can show slug preview here if needed
        console.log('Slug akan menjadi:', slug);
    });
</script>
@endpush
