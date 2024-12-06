<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to your CSV file
        $path = storage_path('app/data obats.csv');
        
        // Read CSV file using League CSV package (you may need to install this package)
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Set the first row as header
        
        // Loop through each row and insert into database
        foreach ($csv as $row) {
            DB::table('obats')->insert([
                'no_bpom' => $row['no_bpom'],
                'nama' => $row['nama_obat'],
                'kategori' => $row['kategori'],
                'jenis_obat' => $row['jenis_obat'],
                'stok' => $row['stok'],
                'harga_satuan' => $row['harga_satuan'],
                'kategori_obat_keras' => $row['kategori_obat_keras'],
                'dosis' => $row['dosis'],
                'aturan_pakai' => $row['aturan_pakai'],
                'rute_obat' => $row['rute_obat'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
