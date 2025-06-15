-- Script untuk cek data berita dan relasi
USE hypenews;

-- Cek semua berita dengan relasi
SELECT 
    b.id,
    b.judul,
    b.status,
    b.user_id,
    u.name as penulis,
    b.kategori_id,
    k.nama as kategori,
    b.created_at
FROM beritas b
LEFT JOIN users u ON b.user_id = u.id
LEFT JOIN kategoris k ON b.kategori_id = k.id
ORDER BY b.id DESC;

-- Cek berita yang tidak punya user
SELECT * FROM beritas WHERE user_id NOT IN (SELECT id FROM users);

-- Cek berita yang tidak punya kategori
SELECT * FROM beritas WHERE kategori_id NOT IN (SELECT id FROM kategoris);

-- Tampilkan total data
SELECT 
    (SELECT COUNT(*) FROM beritas) as total_berita,
    (SELECT COUNT(*) FROM users) as total_users,
    (SELECT COUNT(*) FROM kategoris) as total_kategoris;
