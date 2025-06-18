<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenaga_kependidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Kolom untuk nama
            $table->string('jabatan'); // Kolom untuk jabatan
            $table->string('unit_kerja'); // Kolom untuk unit kerja
            $table->string('gambar'); // Kolom untuk menyimpan path/nama file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_kependidikan');
    }
};