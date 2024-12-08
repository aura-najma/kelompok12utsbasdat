<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Pembelian;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Periode waktu yang ingin kita buat transaksi
        $periods = [
            '2024-01-01' => '2024-03-31', // Periode 1: Januari-Maret 2024
            '2024-04-01' => '2024-06-30', // Periode 2: April-Juni 2024
            '2024-07-01' => '2024-09-30', // Periode 3: Juli-September 2024
        ];

        foreach ($periods as $startDate => $endDate) {
            // Mendapatkan semua pembelian yang terjadi pada periode ini
            $pembelians = Pembelian::whereBetween('created_at', [$startDate, $endDate])->get();

            // Setiap pembelian harus memiliki minimal satu transaksi
            foreach ($pembelians as $pembelian) {
                // Pastikan setiap pembelian memiliki minimal satu transaksi
                Transaksi::factory()->create([
                    'id_pembelian' => $pembelian->id_pembelian,
                    'created_at' => $pembelian->created_at,
                ]);
            }

            // Jika transaksi untuk periode ini kurang dari 500, tambahkan transaksi sampai memenuhi jumlah 500
            $existingTransactions = Transaksi::whereBetween('created_at', [$startDate, $endDate])->count();
            $transactionsToCreate = max(0, 500 - $existingTransactions); // Tambahkan transaksi jika kurang dari 500

            // Buat transaksi tambahan sampai mencapai 500 transaksi untuk periode ini
            Transaksi::factory($transactionsToCreate)->create([
                'created_at' => Carbon::parse($startDate)->addMinutes(rand(3, 15)), // Set waktu acak
            ]);
        }
    }
}
