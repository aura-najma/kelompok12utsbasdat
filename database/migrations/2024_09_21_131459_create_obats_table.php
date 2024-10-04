<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->string('no_bpom')->primary(); // No BPOM sebagai primary key
            $table->string('nama'); // Nama obat
            $table->string('kategori'); // Kategori
            $table->string('jenis_obat'); // Jenis obat
            $table->integer('stok'); // Stok
            $table->date('tanggal_produksi'); // Tanggal produksi
            $table->date('tanggal_kadaluwarsa'); // Tanggal kadaluwarsa
            $table->decimal('harga_satuan', 8, 2); // Harga satuan
            $table->string('kategori_obat_keras')->nullable(); // Kategori obat keras, nullable jika tidak ada
            $table->string('dosis'); // Dosis
            $table->string('aturan_pakai'); // Aturan pakai
            $table->string('rute_obat'); // Rute obat
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
