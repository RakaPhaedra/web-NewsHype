@extends('layouts.app')

@section('title', 'Edit Profile - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Profile</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        @if($user->avatar)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/avatars/' . $user->avatar) }}" 
                                 alt="Current Avatar" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px;">
                            <p class="text-muted">Avatar saat ini</p>
                        </div>
                        @endif
                        <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="font-weight-bold text-primary">Ubah Password</h6>
                    <p class="text-muted">Kosongkan jika tidak ingin mengubah password</p>

                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password">
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
            </div>
            <div class="card-body">
                <p><strong>Role:</strong> <span class="badge badge-primary">{{ ucfirst($user->role) }}</span></p>
                <p><strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>
                <p><strong>Terakhir Update:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
                
                @if($user->provider)
                <p><strong>Login via:</strong> 
                    <span class="badge badge-success">
                        <i class="fab fa-{{ $user->provider }}"></i> {{ ucfirst($user->provider) }}
                    </span>
                </p>
                @endif
                
                @if($user->isWartawan())
                <hr>
                <p><strong>Total Berita:</strong> {{ $user->beritas()->count() }}</p>
                <p><strong>Berita Published:</strong> {{ $user->beritas()->where('status', 'published')->count() }}</p>
                @endif
            </div>
        </div>

        <!-- Google Account Management -->
        @if($user->google_id)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fab fa-google"></i> Google Account
                </h6>
            </div>
            <div class="card-body">
                <p class="text-success">
                    <i class="fas fa-check-circle"></i> Akun terhubung dengan Google
                </p>
                <p class="text-muted small">Anda dapat login menggunakan akun Google</p>
                
                <form action="{{ route('auth.google.unlink') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                            onclick="return confirm('Yakin ingin memutus koneksi dengan Google? Pastikan Anda sudah set password untuk login manual.')">
                        <i class="fas fa-unlink"></i> Putus Koneksi Google
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fab fa-google"></i> Google Account
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted">Hubungkan akun dengan Google untuk login yang lebih mudah</p>
                
                <a href="{{ route('auth.google') }}" class="btn btn-danger btn-sm">
                    <i class="fab fa-google"></i> Hubungkan dengan Google
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
