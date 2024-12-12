<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintFromIdInvoice extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropUnique('id_invoice'); // Hapus constraint unik dari id_invoice
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unique('id_invoice'); // Tambahkan kembali constraint unik jika rollback dilakukan
        });
    }
}
