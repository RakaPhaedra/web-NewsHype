<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'status',
        'catatan_editor',
        'user_id',
        'kategori_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi dengan user (penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Scope untuk berita yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk berita draft
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // PERBAIKAN: Nama method yang benar
    public function scopeMenungguReview($query)
    {
        return $query->where('status', 'menunggu_review');
    }
}
