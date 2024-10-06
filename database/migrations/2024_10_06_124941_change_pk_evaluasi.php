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
        Schema::table('evaluasi', function (Blueprint $table) {
            // Menghapus primary key dari kolom 'id'
            $table->dropPrimary();

            // Menjadikan 'id_evaluasi' sebagai primary key
            $table->string('id_evaluasi', 255)->primary()->change();
        });

        // Hapus kolom 'id' karena sudah tidak diperlukan
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }

    public function down()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            // Mengembalikan kolom 'id' sebagai primary key
            $table->bigIncrements('id')->first();
            $table->dropPrimary(['id_evaluasi']);
            $table->dropColumn('id_evaluasi');
        });
    }
};
