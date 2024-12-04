<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->string('ID_Kecamatan')->primary(); // ID_Kecamatan sebagai primary key
            $table->string('Kecamatan'); // Nama Kecamatan
            $table->timestamps(); // Kolom created_at dan updated_at
        });

        // Data kecamatan
        $kecamatans = [
            'Asemrowo',
            'Benowo',
            'Bubutan',
            'Bulak',
            'Dukuh Pakis',
            'Gayungan',
            'Genteng',
            'Gubeng',
            'Gunung Anyar',
            'Jambangan',
            'Karang Pilang',
            'Kenjeran',
            'Krembangan',
            'Lakarsantri',
            'Mulyorejo',
            'Pabean Cantian',
            'Pakal',
            'Rungkut',
            'Sambikerep',
            'Sawahan',
            'Semampir',
            'Simokerto',
            'Sukolilo',
            'Sukomanunggal',
            'Tambaksari',
            'Tandes',
            'Tegalsari',
            'Tenggilis Mejoyo',
            'Wiyung',
            'Wonocolo',
            'Wonokromo',
        ];

        // Menambahkan data kecamatan dengan format ID_Kecamatan KC-1, KC-2, dst.
        $dataToInsert = [];
        foreach ($kecamatans as $index => $kecamatan) {
            $dataToInsert[] = [
                'ID_Kecamatan' => 'KC-' . ($index + 1),
                'Kecamatan' => $kecamatan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke tabel kecamatans
        DB::table('kecamatans')->insert($dataToInsert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel jika diperlukan rollback
        Schema::dropIfExists('kecamatans');
    }
}
