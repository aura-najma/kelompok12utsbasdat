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
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->timestamp('evaluasi_dibuat')->nullable(); // Kolom custom untuk waktu pembuatan
            $table->timestamp('evaluasi_diperbarui')->nullable(); // Kolom custom untuk waktu pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->dropColumn(['evaluasi_dibuat', 'evaluasi_diperbarui']); // Hapus kolom jika rollback
        });
    }
};
