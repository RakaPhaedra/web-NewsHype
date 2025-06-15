<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\User;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalBerita = Berita::count();
        $totalUser = User::count();
        $totalKategori = Kategori::count();
        $beritaMenunggu = Berita::where('status', 'menunggu_review')->count();

        return view('dashboard.admin', compact('totalBerita', 'totalUser', 'totalKategori', 'beritaMenunggu'));
    }

    public function editor()
    {
        $totalBerita = Berita::count();
        $beritaMenunggu = Berita::where('status', 'menunggu_review')->count();
        $beritaPublished = Berita::where('status', 'published')->count();
        $beritaTerbaru = Berita::where('status', 'menunggu_review')
            ->with(['user', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.editor', compact('totalBerita', 'beritaMenunggu', 'beritaPublished', 'beritaTerbaru'));
    }

    public function wartawan()
    {
        $user = auth()->user();
        $totalBerita = $user->beritas()->count();
        $beritaDraft = $user->beritas()->where('status', 'draft')->count();
        $beritaMenunggu = $user->beritas()->where('status', 'menunggu_review')->count();
        $beritaPublished = $user->beritas()->where('status', 'published')->count();

        return view('dashboard.wartawan', compact('totalBerita', 'beritaDraft', 'beritaMenunggu', 'beritaPublished'));
    }
}
