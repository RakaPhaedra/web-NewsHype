<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat user admin utama
        User::firstOrCreate([
            'email' => 'admin@hypenews.com'
        ], [
            'name' => 'Admin HypeNews',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Administrator HypeNews'
        ]);

        // Buat super admin
        User::firstOrCreate([
            'email' => 'superadmin@hypenews.com'
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'bio' => 'Super Administrator HypeNews'
        ]);

        // Buat admin tambahan untuk testing
        User::firstOrCreate([
            'email' => 'admin.test@hypenews.com'
        ], [
            'name' => 'Admin Test',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'bio' => 'Admin untuk testing'
        ]);

        echo "✅ Admin users berhasil dibuat!\n";
    }
}
