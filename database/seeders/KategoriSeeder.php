<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            [
                'nama' => 'Politik',
                'slug' => 'politik',
                'deskripsi' => 'Berita politik terkini dan pemerintahan'
            ],
            [
                'nama' => 'Ekonomi',
                'slug' => 'ekonomi',
                'deskripsi' => 'Berita ekonomi, bisnis, dan keuangan'
            ],
            [
                'nama' => 'Olahraga',
                'slug' => 'olahraga',
                'deskripsi' => 'Berita olahraga dan pertandingan'
            ],
            [
                'nama' => 'Teknologi',
                'slug' => 'teknologi',
                'deskripsi' => 'Berita teknologi dan inovasi terbaru'
            ],
            [
                'nama' => 'Hiburan',
                'slug' => 'hiburan',
                'deskripsi' => 'Berita hiburan, selebriti, dan lifestyle'
            ],
            [
                'nama' => 'Kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'Berita kesehatan dan tips hidup sehat'
            ],
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Berita pendidikan dan dunia akademik'
            ],
            [
                'nama' => 'Internasional',
                'slug' => 'internasional',
                'deskripsi' => 'Berita luar negeri dan hubungan internasional'
            ]
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
