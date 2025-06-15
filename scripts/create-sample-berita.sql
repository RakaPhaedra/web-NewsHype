-- Script untuk membuat berita sample
USE hypenews;

-- Cek data yang ada
SELECT 'Data saat ini:' as info;
SELECT 
    b.id,
    b.judul,
    b.status,
    b.user_id,
    u.name as penulis,
    b.kategori_id,
    k.nama as kategori
FROM beritas b
LEFT JOIN users u ON b.user_id = u.id
LEFT JOIN kategoris k ON b.kategori_id = k.id
ORDER BY b.id;

-- Hapus berita lama jika ada
DELETE FROM beritas;
ALTER TABLE beritas AUTO_INCREMENT = 1;

-- Pastikan ada user dan kategori
INSERT IGNORE INTO users (id, name, email, password, role, created_at, updated_at) VALUES
(1, 'Admin HypeNews', 'admin@hypenews.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
(2, 'Editor HypeNews', 'editor@hypenews.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor', NOW(), NOW()),
(3, 'Wartawan HypeNews', 'wartawan@hypenews.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wartawan', NOW(), NOW());

-- Pastikan ada kategori
INSERT IGNORE INTO kategoris (id, nama, slug, deskripsi, created_at, updated_at) VALUES
(1, 'Politik', 'politik', 'Berita politik terkini', NOW(), NOW()),
(2, 'Ekonomi', 'ekonomi', 'Berita ekonomi dan bisnis', NOW(), NOW()),
(3, 'Olahraga', 'olahraga', 'Berita olahraga', NOW(), NOW()),
(4, 'Teknologi', 'teknologi', 'Berita teknologi', NOW(), NOW());

-- Buat berita sample
INSERT INTO beritas (judul, slug, konten, gambar, status, user_id, kategori_id, published_at, created_at, updated_at) VALUES
(
    'Perkembangan Teknologi AI di Indonesia Tahun 2024',
    'perkembangan-teknologi-ai-di-indonesia-tahun-2024',
    'Teknologi Artificial Intelligence (AI) mengalami perkembangan pesat di Indonesia pada tahun 2024. Berbagai startup dan perusahaan teknologi mulai mengadopsi AI untuk meningkatkan efisiensi bisnis mereka.

Menurut data dari Kementerian Komunikasi dan Informatika, investasi di bidang AI meningkat hingga 150% dibandingkan tahun sebelumnya. Hal ini menunjukkan antusiasme yang tinggi dari para pelaku industri teknologi.

Beberapa sektor yang paling banyak mengadopsi AI antara lain:
- Perbankan dan fintech
- E-commerce dan retail
- Kesehatan dan farmasi
- Pendidikan online

Pemerintah juga telah menyiapkan roadmap pengembangan AI nasional yang akan diluncurkan pada kuartal kedua tahun ini. Roadmap tersebut mencakup regulasi, infrastruktur, dan pengembangan talenta di bidang AI.',
    NULL,
    'published',
    3,
    4,
    NOW(),
    NOW(),
    NOW()
),
(
    'Ekonomi Indonesia Tumbuh 5.2% di Kuartal Pertama',
    'ekonomi-indonesia-tumbuh-52-di-kuartal-pertama',
    'Badan Pusat Statistik (BPS) mengumumkan bahwa ekonomi Indonesia tumbuh 5.2% year-on-year di kuartal pertama tahun ini. Angka ini melampaui ekspektasi para ekonom yang memperkirakan pertumbuhan sebesar 5.0%.

Pertumbuhan ini didorong oleh beberapa faktor utama:

1. Konsumsi rumah tangga yang meningkat 5.1%
2. Investasi yang tumbuh 4.8%
3. Ekspor yang mengalami peningkatan 6.2%
4. Belanja pemerintah yang naik 3.5%

Menteri Keuangan menyatakan bahwa capaian ini menunjukkan resiliensi ekonomi Indonesia di tengah ketidakpastian global. Pemerintah optimis dapat mempertahankan momentum pertumbuhan ini hingga akhir tahun.

Sektor yang paling berkontribusi terhadap pertumbuhan adalah manufaktur, perdagangan, dan jasa keuangan. Sementara itu, sektor pertanian mengalami sedikit kontraksi akibat cuaca yang tidak menentu.',
    NULL,
    'published',
    3,
    2,
    NOW(),
    NOW(),
    NOW()
),
(
    'Tim Nasional Indonesia Lolos ke Semifinal Piala Asia',
    'tim-nasional-indonesia-lolos-ke-semifinal-piala-asia',
    'Tim Nasional Indonesia berhasil melaju ke semifinal Piala Asia setelah mengalahkan Jepang dengan skor 2-1 dalam pertandingan yang berlangsung dramatis di Stadion Utama Gelora Bung Karno.

Gol kemenangan Indonesia dicetak oleh striker andalan pada menit ke-89 melalui tendangan penalti. Sebelumnya, Indonesia tertinggal 0-1 pada babak pertama, namun berhasil menyamakan kedudukan melalui gol spektakuler dari luar kotak penalti.

Pelatih Tim Nasional mengungkapkan rasa bangganya terhadap perjuangan para pemain. "Ini adalah hasil kerja keras seluruh tim. Para pemain menunjukkan mental juara dan tidak pernah menyerah," ujarnya dalam konferensi pers.

Dengan lolos ke semifinal, Indonesia akan menghadapi Korea Selatan yang sebelumnya mengalahkan Australia. Pertandingan semifinal dijadwalkan berlangsung pada hari Kamis mendatang.

Pencapaian ini merupakan yang terbaik bagi Tim Nasional Indonesia dalam 20 tahun terakhir di ajang Piala Asia.',
    NULL,
    'menunggu_review',
    3,
    3,
    NULL,
    NOW(),
    NOW()
),
(
    'Kebijakan Baru Pemerintah untuk UMKM',
    'kebijakan-baru-pemerintah-untuk-umkm',
    'Pemerintah mengumumkan paket kebijakan baru untuk mendukung Usaha Mikro, Kecil, dan Menengah (UMKM) di seluruh Indonesia. Kebijakan ini mencakup kemudahan akses kredit, insentif pajak, dan program digitalisasi.

Program utama yang diluncurkan meliputi:
- Kredit dengan bunga 3% untuk UMKM
- Pembebasan pajak untuk omzet di bawah 500 juta
- Pelatihan digital marketing gratis
- Bantuan platform e-commerce

Menteri Koperasi dan UKM menyatakan bahwa program ini diharapkan dapat meningkatkan kontribusi UMKM terhadap PDB nasional dari 60% menjadi 65% dalam tiga tahun ke depan.',
    NULL,
    'draft',
    3,
    1,
    NULL,
    NOW(),
    NOW()
);

-- Tampilkan hasil
SELECT 'Berita berhasil dibuat!' as message;
SELECT 
    b.id,
    b.judul,
    b.status,
    u.name as penulis,
    k.nama as kategori
FROM beritas b
JOIN users u ON b.user_id = u.id
JOIN kategoris k ON b.kategori_id = k.id
ORDER BY b.id;
