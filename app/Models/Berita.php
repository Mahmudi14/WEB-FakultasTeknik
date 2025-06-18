<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'status',
        'published_at',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relasi many-to-many ke model Kategori.
     * Sebuah berita bisa memiliki banyak kategori.
     */
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'berita_kategori');
    }
}