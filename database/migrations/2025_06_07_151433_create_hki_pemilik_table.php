<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Ini adalah tabel PIVOT
        Schema::create('hki_pemilik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hki_id')->constrained('hki')->onDelete('cascade');
            $table->foreignId('pemilik_id')->constrained('pemilik')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('hki_pemilik');
    }
};