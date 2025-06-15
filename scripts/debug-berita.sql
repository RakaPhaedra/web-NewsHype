-- Script untuk debug berita dan user
USE hypenews;

-- Cek data berita
SELECT 
    b.id,
    b.judul,
    b.status,
    b.user_id,
    u.name as penulis,
    u.role,
    b.created_at
FROM beritas b
LEFT JOIN users u ON b.user_id = u.id
ORDER BY b.id DESC;

-- Cek user yang sedang login
SELECT id, name, email, role FROM users;

-- Cek apakah ada berita dengan ID 1
SELECT * FROM beritas WHERE id = 1;
