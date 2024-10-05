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
        Schema::table('transaksis', function (Blueprint $table) {
            // Mengganti nama kolom `new_id` menjadi `id_pembelian`
            $table->renameColumn('new_id', 'id_pembelian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Mengembalikan nama kolom `id_pembelian` menjadi `new_id`
            $table->renameColumn('id_pembelian', 'new_id');
        });
    }
};