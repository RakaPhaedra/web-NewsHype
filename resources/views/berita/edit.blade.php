@extends('layouts.app')

@section('title', 'Edit Berita - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
    <a href="{{ route('berita.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Berita</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="judul">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
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
                            <option value="{{ $kategori->id }}" 
                                {{ old('kategori_id', $berita->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar Berita</label>
                        @if($berita->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" 
                                 alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                        @endif
                        <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" 
                               id="gambar" name="gambar" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                        @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="konten">Konten Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" 
                                  id="konten" name="konten" rows="10" required>{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Berita
                        </button>
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
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
    CKEDITOR.replace('konten', {
        height: 300,
        filebrowserUploadUrl: "{{ route('berita.update', $berita) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endpush
