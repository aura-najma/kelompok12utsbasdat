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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('id_invoice')->after('id_pembelian'); // Tambahkan kolom id_invoice
        });
    }
    
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('id_invoice');
        });
    }
    
};
