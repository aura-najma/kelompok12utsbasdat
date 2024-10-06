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
        // Menghapus auto_increment dari kolom 'id'
        Schema::table('evaluasi', function (Blueprint $table) {
            // Pertama, ubah kolom 'id' menjadi nullable untuk sementara, karena kita akan menggantinya
            $table->unsignedBigInteger('id')->nullable()->change();
        });

        // Buat migrasi baru untuk menjadikan 'id' tidak auto_increment tanpa nullable
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });
    }

    public function down()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            // Mengembalikan 'id' menjadi auto_increment
            $table->bigIncrements('id')->change();
        });
    }
};
