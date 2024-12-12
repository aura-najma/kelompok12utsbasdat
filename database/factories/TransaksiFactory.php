<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\Obat;
use App\Models\Apoteker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition()
    {
        // Ambil data pembelian secara acak
        $pembelian = Pembelian::inRandomOrder()->first();

        // Validasi obat berdasarkan resep
        if ($pembelian->resep === 'Tidak Ada Resep') {
            $obat = Obat::where('jenis_obat', '!=', 'Obat Keras')->inRandomOrder()->first();
            if (!$obat) {
                throw new \Exception('Tidak ada obat non-keras yang tersedia untuk pembelian tanpa resep.');
            }
        } else {
            $obat = Obat::inRandomOrder()->first();
        }

        // Detail obat
        $noBpom = $obat->no_bpom;
        $hargaSatuan = $obat->harga_satuan;
        $jumlahObat = rand(1, 5);
        $hargaTotal = $hargaSatuan * $jumlahObat;

        // Gunakan timestamp saat ini untuk ID
        $createdAtTransaksi = Carbon::parse($pembelian->custom_created_at);
        $timestamp = $createdAtTransaksi->format('Ymd');

        // Gunakan format ID Transaksi dengan 3 karakter acak yang unik dan timestamp
        $randomChars = Str::random(3);
        $idTransaksi = 'TR-' . $randomChars . '-' . $timestamp;

        // Gunakan format ID Invoice dengan 3 karakter acak yang unik dan timestamp
        $randomInvoiceChars = Str::random(3);
        $idInvoice = 'INV-' . $randomInvoiceChars . '-' . $timestamp;

        return [
            'id_transaksi' => $idTransaksi,
            'no_bpom' => $noBpom,
            'id_pembelian' => $pembelian->id_pembelian,
            'id_invoice' => $idInvoice,
            'nama_obat' => $obat->nama,
            'jumlah_obat' => $jumlahObat,
            'harga_satuan' => $hargaSatuan,
            'harga_total' => $hargaTotal,
            'created_at' => $createdAtTransaksi,
            'updated_at' => $createdAtTransaksi,
            'confirmed_at' => $createdAtTransaksi,
        ];
    }
}
