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
        Schema::table('pembelians', function (Blueprint $table) {
            // Menambahkan foreign key pada kolom nip di tabel pembelians
            $table->foreign('nip')->references('NIP')->on('apoteker')
                  ->onDelete('set null')  // Menentukan tindakan jika data apoteker dihapus
                  ->onUpdate('cascade');  // Menentukan tindakan jika NIP diubah
        });
    }
    
    public function down()
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // Menghapus foreign key jika migrasi di-rollback
            $table->dropForeign(['nip']);
        });
    }
    
};
