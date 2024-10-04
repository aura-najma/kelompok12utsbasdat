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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_telepon'); // pastikan sama dengan migration `pasiens`
            $table->text('keluhan');
            $table->string('resep')->nullable();
            $table->timestamps();
        
            // Foreign key yang menghubungkan ke tabel `pasiens`
            $table->foreign('no_telepon')->references('no_telepon')->on('pasiens');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
