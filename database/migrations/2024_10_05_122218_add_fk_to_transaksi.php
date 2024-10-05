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
            $table->foreign('id_pembelian')
                  ->references('id_pembelian')
                  ->on('pembelians')
                  ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['id_pembelian']);
        });
    }
    
};
