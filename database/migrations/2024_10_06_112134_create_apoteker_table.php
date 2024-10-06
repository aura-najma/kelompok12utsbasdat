<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApotekerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apoteker', function (Blueprint $table) {
            $table->id('NIP'); // Primary key untuk NIP apoteker
            $table->string('password'); // Password untuk login apoteker
            $table->string('user'); // Nama lengkap apoteker
            $table->string('no_hp'); // Nomor HP apoteker
            $table->string('email')->unique(); // Email harus unik
            $table->string('alamat'); // Alamat tempat tinggal apoteker
            $table->string('jam_kerja'); // Jam kerja apoteker
            $table->timestamps(); // Created_at dan Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apoteker'); // Menghapus tabel apoteker jika dibatalkan
    }
}
