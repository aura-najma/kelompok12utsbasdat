<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id_invoice')->primary();
            $table->string('id_pembelian')->index();
            $table->string('id_transaksi')->index();
            $table->string('nama_obat');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('harga_total', 10, 2);
            $table->string('dosis');
            $table->string('aturan_pakai');
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('id_pembelian')->references('id_pembelian')->on('pembelians')->onDelete('cascade');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['id_pembelian']);
            $table->dropForeign(['id_transaksi']);
        });
        Schema::dropIfExists('invoices');
    }
}

