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
        Schema::create('halaman_utama', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title'); // Untuk judul besar di hero section
            $table->text('sambutan_dekan'); // Untuk paragraf sambutan dekan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halaman_utama');
    }
};