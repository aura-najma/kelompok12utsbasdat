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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id_invoice'); // Primary key
            $table->unsignedBigInteger('id_pembelian'); // Foreign key ke table pembelians
            $table->unsignedBigInteger('id_transaksi'); // Foreign key ke table transaksi
            $table->string('nama_obat');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('harga_total', 10, 2);
            $table->string('dosis');
            $table->string('aturan_pakai');
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('id_pembelian')->references('id_pembelian')->on('pembelians');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksis');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
