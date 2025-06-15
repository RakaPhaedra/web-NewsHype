<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat user admin
        User::create([
            'name' => 'Admin HypeNews',
            'email' => 'admin@hypenews.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Administrator HypeNews'
        ]);

        // Buat user editor
        User::create([
            'name' => 'Editor HypeNews',
            'email' => 'editor@hypenews.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'bio' => 'Editor HypeNews'
        ]);

        // Buat user wartawan
        User::create([
            'name' => 'Wartawan HypeNews',
            'email' => 'wartawan@hypenews.com',
            'password' => Hash::make('password'),
            'role' => 'wartawan',
            'bio' => 'Wartawan HypeNews'
        ]);

        // Jalankan KategoriSeeder
        $this->call([
            KategoriSeeder::class,
        ]);
    }
}
