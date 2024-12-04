<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        // Menentukan path file CSV
        $csvFile = storage_path('app/kelurahan.csv');

        // Periksa jika file ada
        if (!File::exists($csvFile)) {
            $this->command->error('File CSV tidak ditemukan!');
            return;
        }

        // Membaca CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Mengatur header di baris pertama
        $csv->setDelimiter(','); // Menentukan delimiter koma

        // Persiapkan array untuk batch insert
        $data = [];

        // Iterasi setiap record dan simpan ke dalam array
        foreach ($csv as $record) {
            $data[] = [
                'ID_Kecamatan' => $record['ID_Kecamatan'],
                'ID_Kelurahan' => $record['ID_Kelurahan'],
                'Kelurahan' => $record['Kelurahan'],
            ];
        }

        // Lakukan insert dalam batch
        if (count($data) > 0) {
            DB::table('kelurahans')->insert($data);
            $this->command->info('Data kelurahan berhasil diinsert.');
        } else {
            $this->command->warn('Tidak ada data untuk diinsert.');
        }
    }
}
