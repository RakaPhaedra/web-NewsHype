@extends('layouts.app')

@section('title', 'Edit Kategori - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kategori</h1>
    <a href="{{ route('kategori.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Kategori</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required 
                               placeholder="Contoh: Politik, Ekonomi, Olahraga...">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Slug saat ini: <code>{{ $kategori->slug }}</code>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" 
                                  placeholder="Deskripsi singkat tentang kategori ini...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Update Kategori
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
                <h6 class="m-0 font-weight-bold text-primary">Informasi Kategori</h6>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $kategori->id }}</p>
                <p><strong>Slug:</strong> <code>{{ $kategori->slug }}</code></p>
                <p><strong>Jumlah Berita:</strong> 
                    <span class="badge badge-info">{{ $kategori->beritas()->count() }} berita</span>
                </p>
                <p><strong>Dibuat:</strong> {{ $kategori->created_at->format('d M Y H:i') }}</p>
                <p><strong>Diupdate:</strong> {{ $kategori->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        @if($kategori->beritas()->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Berita Terkait</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($kategori->beritas()->latest()->take(5)->get() as $berita)
                    <div class="list-group-item px-0">
                        <h6 class="mb-1">{{ Str::limit($berita->judul, 40) }}</h6>
                        <small class="text-muted">{{ $berita->created_at->format('d M Y') }}</small>
                        <span class="badge badge-sm badge-{{ $berita->status == 'published' ? 'success' : ($berita->status == 'draft' ? 'secondary' : 'warning') }}">
                            {{ ucfirst($berita->status) }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @if($kategori->beritas()->count() > 5)
                <small class="text-muted">Dan {{ $kategori->beritas()->count() - 5 }} berita lainnya...</small>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
