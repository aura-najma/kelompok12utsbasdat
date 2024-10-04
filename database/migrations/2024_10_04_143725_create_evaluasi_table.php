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
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembeli');
            $table->date('tanggal_transaksi');
            $table->string('evaluasi_apotek');
            $table->string('evaluasi_pelayanan');
            $table->string('evaluasi_obat');
            $table->integer('rating_apotek');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi');
    }
};
