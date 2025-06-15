<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin() || $user->isEditor()) {
            $beritas = Berita::with(['user', 'kategori'])->latest()->paginate(10);
        } else {
            $beritas = $user->beritas()->with('kategori')->latest()->paginate(10);
        }

        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('berita.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $counter = 1;

        // Pastikan slug unik
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data = [
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'user_id' => auth()->id(),
            'status' => 'draft',
        ];

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            
            // Buat folder jika belum ada
            if (!file_exists(public_path('uploads/berita'))) {
                mkdir(public_path('uploads/berita'), 0755, true);
            }
            
            $gambar->move(public_path('uploads/berita'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat!');
    }

    public function show(Berita $berita)
    {
        // PERBAIKAN: Load relasi user dan kategori
        $berita->load(['user', 'kategori']);
        
        // Cek apakah berita ada dan relasi ter-load
        if (!$berita->exists || !$berita->user || !$berita->kategori) {
            abort(404, 'Berita tidak ditemukan atau data tidak lengkap.');
        }
        
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        // PERBAIKAN: Load relasi dan cek keberadaan
        $berita->load(['user', 'kategori']);
        
        if (!$berita->exists) {
            abort(404, 'Berita tidak ditemukan.');
        }
        
        $user = auth()->user();
        
        if ($user->isAdmin() || $user->isEditor() || $berita->user_id === $user->id) {
            $kategoris = Kategori::all();
            return view('berita.edit', compact('berita', 'kategoris'));
        }
        
        abort(403, 'Anda tidak memiliki akses untuk mengedit berita ini.');
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
        ];

        // Update slug jika judul berubah
        if ($berita->judul !== $request->judul) {
            $slug = Str::slug($request->judul);
            $originalSlug = $slug;
            $counter = 1;

            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            
            // Buat folder jika belum ada
            if (!file_exists(public_path('uploads/berita'))) {
                mkdir(public_path('uploads/berita'), 0755, true);
            }
            
            $gambar->move(public_path('uploads/berita'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy(Berita $berita)
    {
        // Cek akses
        $user = auth()->user();
        if (!$user->isAdmin() && $berita->user_id !== $user->id) {
            abort(403);
        }

        // Hapus gambar jika ada
        if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    // Submit untuk review (wartawan)
    public function submitReview(Berita $berita)
    {
        if ($berita->user_id !== auth()->id()) {
            abort(403);
        }

        $berita->update(['status' => 'menunggu_review']);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disubmit untuk review!');
    }

    // Approve berita (editor)
    public function approve(Request $request, Berita $berita)
    {
        if (!auth()->user()->isEditor() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $berita->update([
            'status' => 'published',
            'published_at' => now(),
            'catatan_editor' => $request->catatan_editor,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dipublish!');
    }

    // Reject berita (editor)
    public function reject(Request $request, Berita $berita)
    {
        if (!auth()->user()->isEditor() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'catatan_editor' => 'required|string',
        ]);

        $berita->update([
            'status' => 'rejected',
            'catatan_editor' => $request->catatan_editor,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditolak!');
    }
}
