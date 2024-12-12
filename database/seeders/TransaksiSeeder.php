<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Pembelian;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Pastikan setiap id_pembelian memiliki minimal satu transaksi
        $pembelians = Pembelian::all();

        foreach ($pembelians as $pembelian) {
            // Periksa apakah id_pembelian sudah memiliki transaksi
            $existingTransaction = Transaksi::where('id_pembelian', $pembelian->id_pembelian)->exists();

            // Jika belum ada transaksi, buat satu transaksi untuk id_pembelian tersebut
            if (!$existingTransaction) {
                Transaksi::factory()->create([
                    'id_pembelian' => $pembelian->id_pembelian,
                    'confirmed_at' => $pembelian->custom_created_at,
                ]);
            }
        }

        // Tambahkan transaksi acak lainnya untuk mencapai total 1000 transaksi
        $totalTransaksi = 1000 - Transaksi::count(); // Hitung transaksi tambahan yang perlu dibuat

        if ($totalTransaksi > 0) {
            Transaksi::factory($totalTransaksi)->create();
        }
    }
}
