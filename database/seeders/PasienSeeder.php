<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    public function run()
    {
        // Membuat 70 data pasien menggunakan factory
        Pasien::factory(300)->create();
    }
}
