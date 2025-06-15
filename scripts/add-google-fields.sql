-- Script untuk menambahkan field Google OAuth ke tabel users
USE hypenews;

-- Cek struktur tabel users saat ini
DESCRIBE users;

-- Tambahkan kolom Google OAuth jika belum ada
ALTER TABLE users 
ADD COLUMN IF NOT EXISTS google_id VARCHAR(255) NULL AFTER email,
ADD COLUMN IF NOT EXISTS provider VARCHAR(255) NULL AFTER google_id;

-- Tambahkan index untuk performa
ALTER TABLE users 
ADD INDEX IF NOT EXISTS idx_google_id (google_id),
ADD INDEX IF NOT EXISTS idx_provider (provider);

-- Tampilkan struktur tabel setelah update
SELECT 'Struktur tabel users setelah update:' as info;
DESCRIBE users;

-- Cek apakah ada user dengan Google ID
SELECT 'User dengan Google OAuth:' as info;
SELECT id, name, email, google_id, provider FROM users WHERE google_id IS NOT NULL;
