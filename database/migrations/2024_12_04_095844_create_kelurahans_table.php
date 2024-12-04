<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelurahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->string('ID_Kelurahan')->primary(); // ID Kelurahan dengan format KL-1, KL-2, dst.
            $table->string('ID_Kecamatan'); // Relasi ke ID_Kecamatan dengan format KC-1, KC-2, dst.
            $table->string('Kelurahan'); // Nama kelurahan
            $table->timestamps();

            // Foreign key ke tabel kecamatans
            $table->foreign('ID_Kecamatan')->references('ID_Kecamatan')->on('kecamatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahans');
    }
}
