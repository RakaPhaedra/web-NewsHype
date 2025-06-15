-- Script untuk setup database HypeNews
-- Buka phpMyAdmin dan jalankan query ini

-- Buat database
CREATE DATABASE IF NOT EXISTS hypenews CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE hypenews;

-- Tampilkan pesan sukses
SELECT 'Database HypeNews berhasil dibuat!' as message;

-- Cek apakah database sudah ada
SHOW DATABASES LIKE 'hypenews';
