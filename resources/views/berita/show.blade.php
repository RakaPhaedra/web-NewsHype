@extends('layouts.app')

@section('title', $berita->judul . ' - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Berita</h1>
    <a href="{{ route('berita.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Status Badge -->
                <div class="mb-3">
                    @if($berita->status == 'draft')
                        <span class="badge badge-secondary badge-lg">Draft</span>
                    @elseif($berita->status == 'menunggu_review')
                        <span class="badge badge-warning badge-lg">Menunggu Review</span>
                    @elseif($berita->status == 'published')
                        <span class="badge badge-success badge-lg">Published</span>
                    @else
                        <span class="badge badge-danger badge-lg">Rejected</span>
                    @endif
                </div>

                <!-- Judul -->
                <h2 class="mb-3">{{ $berita->judul }}</h2>

                <!-- Meta Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-user"></i> 
                            @if($berita->user)
                                {{ $berita->user->name }}
                            @else
                                <span class="text-danger">User tidak ditemukan</span>
                            @endif
                        </small>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> {{ $berita->created_at->format('d M Y H:i') }}
                        </small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-tag"></i> 
                            @if($berita->kategori)
                                {{ $berita->kategori->nama }}
                            @else
                                <span class="text-danger">Kategori tidak ditemukan</span>
                            @endif
                        </small>
                    </div>
                    @if($berita->published_at)
                    <div class="col-md-6 text-md-right">
                        <small class="text-muted">
                            <i class="fas fa-globe"></i> Published: {{ $berita->published_at->format('d M Y H:i') }}
                        </small>
                    </div>
                    @endif
                </div>

                <hr>

                <!-- Gambar -->
                @if($berita->gambar)
                <div class="text-center mb-4">
                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" 
                         alt="{{ $berita->judul }}" class="img-fluid rounded shadow">
                </div>
                @endif

                <!-- Konten -->
                <div class="content" style="line-height: 1.8; font-size: 16px;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                <!-- Catatan Editor -->
                @if($berita->catatan_editor)
                <hr>
                <div class="alert alert-info">
                    <h6><i class="fas fa-sticky-note"></i> Catatan Editor:</h6>
                    <p class="mb-0">{{ $berita->catatan_editor }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Actions Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                @if(auth()->user()->isAdmin() || auth()->user()->isEditor() || $berita->user_id == auth()->id())
                <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning btn-block mb-2">
                    <i class="fas fa-edit"></i> Edit Berita
                </a>
                @endif

                @if($berita->status == 'draft' && $berita->user_id == auth()->id())
                <form action="{{ route('berita.submit-review', $berita) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block mb-2" 
                            onclick="return confirm('Submit berita untuk review?')">
                        <i class="fas fa-paper-plane"></i> Submit untuk Review
                    </button>
                </form>
                @endif

                @if($berita->status == 'menunggu_review' && (auth()->user()->isEditor() || auth()->user()->isAdmin()))
                <button type="button" class="btn btn-success btn-block mb-2" 
                        data-toggle="modal" data-target="#approveModal">
                    <i class="fas fa-check"></i> Approve & Publish
                </button>
                <button type="button" class="btn btn-danger btn-block mb-2" 
                        data-toggle="modal" data-target="#rejectModal">
                    <i class="fas fa-times"></i> Reject
                </button>
                @endif

                @if(auth()->user()->isAdmin() || $berita->user_id == auth()->id())
                <form action="{{ route('berita.destroy', $berita) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block" 
                            onclick="return confirm('Yakin ingin menghapus berita ini?')">
                        <i class="fas fa-trash"></i> Hapus Berita
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $berita->id }}</p>
                <p><strong>Slug:</strong> {{ $berita->slug }}</p>
                <p><strong>Dibuat:</strong> {{ $berita->created_at->format('d M Y H:i') }}</p>
                <p><strong>Diupdate:</strong> {{ $berita->updated_at->format('d M Y H:i') }}</p>
                @if($berita->published_at)
                <p><strong>Dipublish:</strong> {{ $berita->published_at->format('d M Y H:i') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
@if($berita->status == 'menunggu_review' && (auth()->user()->isEditor() || auth()->user()->isAdmin()))
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Berita</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('berita.approve', $berita) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Yakin ingin mempublish berita ini?</p>
                    <div class="form-group">
                        <label>Catatan Editor (Opsional)</label>
                        <textarea name="catatan_editor" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Berita</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('berita.reject', $berita) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Yakin ingin menolak berita ini?</p>
                    <div class="form-group">
                        <label>Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="catatan_editor" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
