<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluasi; // Sesuaikan dengan model Anda

class EvaluasiSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan factory untuk membuat data evaluasi
        \App\Models\Evaluasi::factory(850)->create(); 
    }
}
