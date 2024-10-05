<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->string('nomor_str')->primary(); // Nomor STR sebagai primary key
            $table->string('nama_dokter'); // Nama dokter
            $table->string('spesialisasi'); // Spesialisasi dokter
            $table->string('alamat'); // Alamat dokter
            $table->string('hubungi', 255); // Menyimpan link, bisa null jika tidak ada nomor
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dokter');
    }
};

