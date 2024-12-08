<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\Obat;
use App\Models\Apoteker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition()
    {
        // Ambil data pembelian secara acak
        $pembelian = Pembelian::inRandomOrder()->first();
        $obat = Obat::inRandomOrder()->first(); // Ambil acak obat
        $nip = Apoteker::inRandomOrder()->first()->NIP; // Ambil NIP apoteker secara acak

        // Tentukan detail obat dan harga
        $noBpom = $obat->no_bpom;
        $hargaSatuan = $obat->harga_satuan;
        $jumlahObat = rand(1, 5); // Jumlah obat yang dibeli (1-5)
        $hargaTotal = $hargaSatuan * $jumlahObat;

        // Jika resep = "Tidak Ada Resep", pastikan obat yang dipilih bukan obat keras
<<<<<<< Updated upstream
       if ($pembelian->resep == 'Tidak Ada Resep') {
    // Coba pilih obat yang bukan obat keras
    $obat = Obat::where('jenis', '!=', 'Obat Keras')->inRandomOrder()->first();

    // Jika tidak ada obat non-keras yang tersedia
    if (!$obat) {
        throw new \Exception('Tidak ada obat non-keras yang tersedia untuk pembelian tanpa resep.');
    }

    // Update detail obat yang dipilih
    $noBpom = $obat->no_bpom;
    $hargaSatuan = $obat->harga_satuan;
    $hargaTotal = $hargaSatuan * $jumlahObat;
}
 $hargaTotal = $hargaSatuan * $jumlahObat;
=======
        if ($pembelian->resep === 'Tidak Ada Resep') {
            $obat = Obat::where('jenis_obat', '!=', 'Obat Keras')->inRandomOrder()->first();
            if (!$obat) {
                throw new \Exception('Tidak ada obat non-keras yang tersedia untuk pembelian tanpa resep.');
            }
            // Update detail obat yang dipilih
            $noBpom = $obat->no_bpom;
            $hargaSatuan = $obat->harga_satuan;
            $hargaTotal = $hargaSatuan * $jumlahObat;
>>>>>>> Stashed changes
        }

        // Format tanggal transaksi
        $tanggalSekarang = Carbon::parse($pembelian->custom_created_at)->format('Y-m-d');
        $createdAtTransaksi = Carbon::parse($pembelian->custom_created_at)->addMinutes(rand(3, 15));

        // Generate ID Transaksi dengan format yang unik
        // Count the existing transactions for the same date
        $existingTransactionsCount = Transaksi::whereDate('created_at', $tanggalSekarang)->count();
        $transactionNumber = str_pad($existingTransactionsCount + 1, 3, '0', STR_PAD_LEFT);

        // Timestamp without microtime, using YmdHis for unique time format
        $timestamp = Carbon::parse($pembelian->custom_created_at)->format('YmdHis');

        // Ensure uniqueness by adding a random string or a unique identifier
        $uniqueSuffix = substr(md5(uniqid(rand(), true)), 0, 4); // Generates a random 4-character suffix

        // Combine the transaction number, timestamp, and random suffix
        $idTransaksi = 'TR-' . $transactionNumber . '-' . $timestamp . $uniqueSuffix;

        // Generate ID Invoice (format yang sama dengan transaksi)
        $existingInvoiceCount = Transaksi::distinct()
            ->whereDate('created_at', $tanggalSekarang)
            ->count('id_invoice');
        $invoiceNumber = str_pad($existingInvoiceCount + 1, 3, '0', STR_PAD_LEFT);
        $idInvoice = 'INV-' . $invoiceNumber . '-' . $timestamp . $uniqueSuffix;

        // Return the generated data for the transaksi
        return [
            'id_transaksi' => $idTransaksi,
            'no_bpom' => $noBpom,
            'id_pembelian' => $pembelian->id_pembelian,
            'id_invoice' => $idInvoice,
            'nip' => $nip,
            'nama_obat' => $obat->nama,
            'jumlah_obat' => $jumlahObat,
            'harga_satuan' => $hargaSatuan,
            'harga_total' => $hargaTotal,
            'created_at' => $createdAtTransaksi,
            'updated_at' => $createdAtTransaksi,
        ];
    }
}
