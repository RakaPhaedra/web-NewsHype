-- Script untuk menambahkan kategori default
-- Jalankan di phpMyAdmin atau MySQL client

USE hypenews;

-- Hapus kategori lama jika ada
DELETE FROM kategoris;

-- Reset auto increment
ALTER TABLE kategoris AUTO_INCREMENT = 1;

-- Insert kategori default
INSERT INTO kategoris (nama, slug, deskripsi, created_at, updated_at) VALUES
('Politik', 'politik', 'Berita politik terkini dan pemerintahan', NOW(), NOW()),
('Ekonomi', 'ekonomi', 'Berita ekonomi, bisnis, dan keuangan', NOW(), NOW()),
('Olahraga', 'olahraga', 'Berita olahraga dan pertandingan', NOW(), NOW()),
('Teknologi', 'teknologi', 'Berita teknologi dan inovasi terbaru', NOW(), NOW()),
('Hiburan', 'hiburan', 'Berita hiburan, selebriti, dan lifestyle', NOW(), NOW()),
('Kesehatan', 'kesehatan', 'Berita kesehatan dan tips hidup sehat', NOW(), NOW()),
('Pendidikan', 'pendidikan', 'Berita pendidikan dan dunia akademik', NOW(), NOW()),
('Internasional', 'internasional', 'Berita luar negeri dan hubungan internasional', NOW(), NOW());

-- Tampilkan hasil
SELECT 'Kategori berhasil ditambahkan!' as message;
SELECT * FROM kategoris;
