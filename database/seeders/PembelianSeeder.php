<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;

class PembelianSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan factory untuk membuat 900 data pembelian
        Pembelian::factory()->count(900)->create();
    }
}
