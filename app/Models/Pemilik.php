<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik';
    protected $fillable = ['nama_pemilik'];

    /**
     * Relasi Many-to-Many ke model HKI.
     * Seorang Pemilik bisa memiliki banyak HKI.
     */
    public function hki()
    {
        return $this->belongsToMany(Hki::class, 'hki_pemilik');
    }
}