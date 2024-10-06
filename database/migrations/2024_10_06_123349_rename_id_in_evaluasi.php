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
            // Menambahkan kolom id_evaluasi sebagai VARCHAR
            $table->string('id_evaluasi', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            // Menghapus kolom id_evaluasi jika rollback
            $table->dropColumn('id_evaluasi');
        });
    }
};
