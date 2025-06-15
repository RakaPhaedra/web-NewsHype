-- Script untuk setup database HypeNews
-- Jalankan script ini di phpMyAdmin atau MySQL client

-- Buat database
CREATE DATABASE IF NOT EXISTS hypenews CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE hypenews;

-- Tampilkan pesan sukses
SELECT 'Database HypeNews berhasil dibuat!' as message;
