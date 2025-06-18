<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKemahasiswaan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_kemahasiswaan';

    /**
     * The attributes that are mass assignable.
     *
     * Properti ini mendefinisikan kolom mana yang boleh diisi
     * secara massal melalui method create() atau update().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'link',
    ];
}