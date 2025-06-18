<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'slug',
    ];

    /**
     * Relasi many-to-many ke model Berita.
     * Sebuah kategori bisa dimiliki oleh banyak berita.
     */
    public function beritas()
    {
        return $this->belongsToMany(Berita::class, 'berita_kategori');
    }

    /**
     * Mengubah kunci rute default menjadi 'slug' untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}