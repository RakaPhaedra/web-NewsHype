@extends('layouts.app')

@section('title', 'Editor Dashboard - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Editor</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Berita Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Berita</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBerita }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Menunggu Review Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Menunggu Review</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $beritaMenunggu }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Published Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Berita Published</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $beritaPublished }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Berita Menunggu Review -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Berita Menunggu Review</h6>
            </div>
            <div class="card-body">
                @if($beritaTerbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritaTerbaru as $berita)
                            <tr>
                                <td>{{ Str::limit($berita->judul, 30) }}</td>
                                <td>{{ $berita->user->name }}</td>
                                <td>{{ $berita->kategori->nama }}</td>
                                <td>{{ $berita->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('berita.show', $berita) }}" class="btn btn-sm btn-info">Review</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center">Tidak ada berita yang menunggu review.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('berita.index') }}" class="btn btn-primary btn-icon-split mb-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-list"></i>
                    </span>
                    <span class="text">Kelola Berita</span>
                </a>
                <br>
                <a href="{{ route('berita.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Buat Berita</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
