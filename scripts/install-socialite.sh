#!/bin/bash

# Script untuk install Laravel Socialite
echo "🚀 Installing Laravel Socialite..."

# Install Socialite via Composer
composer require laravel/socialite

echo "✅ Laravel Socialite berhasil diinstall!"

# Cek apakah Socialite sudah terinstall
composer show laravel/socialite

echo "📝 Jangan lupa:"
echo "1. Setup Google OAuth di Google Cloud Console"
echo "2. Update .env dengan GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET"
echo "3. Jalankan migration: php artisan migrate"
