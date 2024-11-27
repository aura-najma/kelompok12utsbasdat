<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNipToTransaksiTable extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('nip')->after('id_pembelian');

            // Tambahkan foreign key ke tabel apoteker
            $table->foreign('nip')->references('NIP')->on('apoteker')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['nip']);
            $table->dropColumn('nip');
        });
    }
}
