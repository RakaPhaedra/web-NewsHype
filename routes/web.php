<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    
    // TAMBAHAN: Google OAuth Routes
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// Route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // TAMBAHAN: Google unlink route
    Route::post('/auth/google/unlink', [GoogleAuthController::class, 'unlinkGoogle'])->name('auth.google.unlink');
    
    // Route dashboard utama yang redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->isEditor()) {
            return redirect()->route('dashboard.editor');
        } else {
            return redirect()->route('dashboard.wartawan');
        }
    })->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Dashboard berdasarkan role
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->name('dashboard.admin')
        ->middleware('role:admin');
    
    Route::get('/dashboard/editor', [DashboardController::class, 'editor'])
        ->name('dashboard.editor')
        ->middleware('role:editor,admin');
    
    Route::get('/dashboard/wartawan', [DashboardController::class, 'wartawan'])
        ->name('dashboard.wartawan')
        ->middleware('role:wartawan,editor,admin');
    
    // Berita routes
    Route::resource('berita', BeritaController::class);
    Route::post('/berita/{berita}/submit-review', [BeritaController::class, 'submitReview'])
        ->name('berita.submit-review')
        ->middleware('role:wartawan,editor,admin');
    
    Route::post('/berita/{berita}/approve', [BeritaController::class, 'approve'])
        ->name('berita.approve')
        ->middleware('role:editor,admin');
    
    Route::post('/berita/{berita}/reject', [BeritaController::class, 'reject'])
        ->name('berita.reject')
        ->middleware('role:editor,admin');
    
    // Kategori routes (hanya admin)
    Route::resource('kategori', KategoriController::class)
        ->middleware('role:admin');
});
