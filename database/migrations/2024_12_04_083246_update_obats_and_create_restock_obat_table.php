<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateObatsAndCreateRestockObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menghapus kolom 'tanggal_kadaluwarsa' dari tabel 'obats'
        Schema::table('obats', function (Blueprint $table) {
            $table->dropColumn('tanggal_kadaluwarsa');
        });

        // Membuat tabel 'restock_obat' untuk mencatat restock obat
        Schema::create('restock_obat', function (Blueprint $table) {
            // Menggunakan string untuk id_restock dengan panjang yang cukup
            $table->string('id_restock', 50)->primary();  // Set primary key dengan custom string id
            $table->string('no_bpom');
            $table->integer('jumlah');
            $table->date('tanggal_kadaluwarsa');
            $table->timestamps();

            // Relasi ke tabel 'obats'
            $table->foreign('no_bpom')->references('no_bpom')->on('obats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rollback perubahan jika migration di-revert
        Schema::table('obats', function (Blueprint $table) {
            $table->date('tanggal_kadaluwarsa');
        });

        // Drop tabel 'restock_obat'
        Schema::dropIfExists('restock_obat');
    }
}
