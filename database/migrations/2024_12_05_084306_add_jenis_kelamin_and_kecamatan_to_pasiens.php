<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisKelaminAndKecamatanToPasiens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            // Menambahkan kolom jenis_kelamin (ENUM)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('nama');

            // Menambahkan kolom ID_Kecamatan
            $table->string('ID_Kecamatan', 10)->after('alamat');  // panjang kolom disesuaikan dengan format "KC-1"

            // Menambahkan foreign key constraint
            $table->foreign('ID_Kecamatan')
                  ->references('ID_Kecamatan')
                  ->on('kecamatans')
                  ->onDelete('cascade');  // Atur sesuai kebijakan Anda
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            // Menghapus foreign key constraint
            $table->dropForeign(['ID_Kecamatan']);

            // Menghapus kolom
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('ID_Kecamatan');
        });
    }
}
