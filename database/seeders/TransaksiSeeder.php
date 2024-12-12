<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Menghasilkan 10 transaksi (bisa disesuaikan jumlahnya)
        \App\Models\Transaksi::factory(1000)->create();
    }
}
