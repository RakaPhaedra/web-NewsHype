<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;
use App\Models\Kategori;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user wartawan
        $wartawan = User::where('role', 'wartawan')->first();
        if (!$wartawan) {
            $wartawan = User::create([
                'name' => 'Wartawan HypeNews',
                'email' => 'wartawan@hypenews.com',
                'password' => bcrypt('password'),
                'role' => 'wartawan',
            ]);
        }

        // Pastikan ada kategori
        $kategoriTeknologi = Kategori::firstOrCreate([
            'nama' => 'Teknologi',
            'slug' => 'teknologi',
            'deskripsi' => 'Berita teknologi terkini'
        ]);

        $kategoriEkonomi = Kategori::firstOrCreate([
            'nama' => 'Ekonomi',
            'slug' => 'ekonomi',
            'deskripsi' => 'Berita ekonomi dan bisnis'
        ]);

        $kategoriOlahraga = Kategori::firstOrCreate([
            'nama' => 'Olahraga',
            'slug' => 'olahraga',
            'deskripsi' => 'Berita olahraga'
        ]);

        // Buat berita sample
        $beritas = [
            [
                'judul' => 'Perkembangan Teknologi AI di Indonesia Tahun 2024',
                'slug' => 'perkembangan-teknologi-ai-di-indonesia-tahun-2024',
                'konten' => 'Teknologi Artificial Intelligence (AI) mengalami perkembangan pesat di Indonesia pada tahun 2024. Berbagai startup dan perusahaan teknologi mulai mengadopsi AI untuk meningkatkan efisiensi bisnis mereka.',
                'status' => 'published',
                'user_id' => $wartawan->id,
                'kategori_id' => $kategoriTeknologi->id,
                'published_at' => now(),
            ],
            [
                'judul' => 'Ekonomi Indonesia Tumbuh 5.2% di Kuartal Pertama',
                'slug' => 'ekonomi-indonesia-tumbuh-52-di-kuartal-pertama',
                'konten' => 'Badan Pusat Statistik (BPS) mengumumkan bahwa ekonomi Indonesia tumbuh 5.2% year-on-year di kuartal pertama tahun ini.',
                'status' => 'published',
                'user_id' => $wartawan->id,
                'kategori_id' => $kategoriEkonomi->id,
                'published_at' => now(),
            ],
            [
                'judul' => 'Tim Nasional Indonesia Lolos ke Semifinal Piala Asia',
                'slug' => 'tim-nasional-indonesia-lolos-ke-semifinal-piala-asia',
                'konten' => 'Tim Nasional Indonesia berhasil melaju ke semifinal Piala Asia setelah mengalahkan Jepang dengan skor 2-1.',
                'status' => 'menunggu_review',
                'user_id' => $wartawan->id,
                'kategori_id' => $kategoriOlahraga->id,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
