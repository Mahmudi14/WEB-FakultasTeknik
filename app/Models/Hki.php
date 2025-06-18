<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hki extends Model
{
    use HasFactory;
    protected $table = 'hki';
    protected $fillable = ['judul_hki', 'jenis_hki', 'nomor_pendaftaran', 'tanggal_pendaftaran'];

    /**
     * Relasi Many-to-Many ke model Pemilik.
     * Sebuah HKI bisa dimiliki oleh banyak Pemilik.
     */
    public function pemilik()
    {
        // Parameter kedua adalah nama tabel pivot
        return $this->belongsToMany(Pemilik::class, 'hki_pemilik');
    }
}