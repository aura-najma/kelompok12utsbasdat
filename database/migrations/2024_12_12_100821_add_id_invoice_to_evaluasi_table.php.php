<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdInvoiceToEvaluasiTable extends Migration
{
    public function up()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            // Tambahkan foreign key pada kolom id_invoice
            $table->foreign('id_invoice')->references('id_invoice')->on('transaksis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            // Hapus foreign key jika migrasi di-rollback
            $table->dropForeign(['id_invoice']);
        });
    }
}
