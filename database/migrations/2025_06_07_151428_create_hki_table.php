<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hki', function (Blueprint $table) {
            $table->id();
            $table->string('judul_hki');
            $table->string('jenis_hki');
            $table->string('nomor_pendaftaran')->nullable()->unique();
            $table->date('tanggal_pendaftaran');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('hki');
    }
};