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
            // Kolom `id_transaksi` custom sebagai primary key
            $table->string('id_transaksi', 20)->primary();
            
            // Kolom `id_pembelian` untuk relasi dengan `new_id` dari tabel `pembelians`
            $table->string('id_pembelian'); 
            $table->string('nama_obat');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('harga_total', 10, 2);
            $table->timestamps();

            // Foreign key constraint ke `new_id` dari `pembelians`
            $table->foreign('id_pembelian')->references('new_id')->on('pembelians');
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
