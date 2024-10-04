<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;
use Illuminate\Support\Facades\DB;

class UpdatePembelianIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            // Loop melalui setiap pembelian dan perbarui ID
            Pembelian::chunkById(100, function ($pembelians) {
                foreach ($pembelians as $pembelian) {
                    // Ambil 4 digit terakhir no_telepon
                    $noTeleponLast4 = substr($pembelian->no_telepon, -4);

                    // Dapatkan timestamp singkat dari waktu pembelian (misalnya created_at)
                    $timestamp = $pembelian->created_at->format('YmdHi');

                    // Buat ID baru
                    $newId = 'PB-' . $noTeleponLast4 . '-' . $timestamp;

                    // Perbarui pembelian dengan ID baru
                    $pembelian->new_id = $newId;
                    $pembelian->save();
                }
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
