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
        Schema::create('berita_kategori', function (Blueprint $table) {
            // Kolom Foreign Key untuk berita
            $table->foreignId('berita_id')->constrained('beritas')->onDelete('cascade');
            // Kolom Foreign Key untuk kategori
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            // Menetapkan primary key gabungan untuk mencegah duplikasi
            $table->primary(['berita_id', 'kategori_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_kategori');
    }
};