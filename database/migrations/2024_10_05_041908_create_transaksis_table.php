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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('id_transaksi')->primary(); // Mengatur id_transaksi sebagai primary key
            $table->string('id_pembelian'); // ID pembelian dari tabel pembelians
            $table->string('nama_obat'); // Nama obat yang dibeli
            $table->integer('jumlah_obat'); // Jumlah obat yang dibeli
            $table->decimal('harga_satuan', 10, 2); // Harga satuan obat
            $table->decimal('harga_total', 10, 2); // Harga total (jumlah_obat * harga_satuan)
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
