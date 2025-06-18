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
        Schema::create('peraturan_kemahasiswaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peraturan'); // Kolom untuk nama peraturan
            $table->string('link'); // Kolom untuk menyimpan URL/link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturan_kemahasiswaan');
    }
};