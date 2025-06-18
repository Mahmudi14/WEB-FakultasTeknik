<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pemilik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik')->unique();
            // Anda bisa menambahkan kolom lain untuk pemilik jika perlu, misal:
            // $table->string('kategori')->comment('Dosen, Mahasiswa, dll');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pemilik');
    }
};