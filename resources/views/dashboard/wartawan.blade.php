@extends('layouts.app')

@section('title', 'Wartawan Dashboard - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Wartawan</h1>
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
                            Total Berita Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBerita }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Draft Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Draft</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $beritaDraft }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-edit fa-2x text-gray-300"></i>
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
                            Published</div>
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

    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('berita.create') }}" class="btn btn-primary btn-icon-split mb-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Buat Berita Baru</span>
                </a>
                <br>
                <a href="{{ route('berita.index') }}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-list"></i>
                    </span>
                    <span class="text">Kelola Berita Saya</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Tips untuk Wartawan -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tips untuk Wartawan</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success"></i> Pastikan judul berita menarik dan informatif</li>
                    <li><i class="fas fa-check text-success"></i> Gunakan gambar yang relevan dengan berita</li>
                    <li><i class="fas fa-check text-success"></i> Pilih kategori yang sesuai</li>
                    <li><i class="fas fa-check text-success"></i> Submit untuk review setelah selesai menulis</li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
