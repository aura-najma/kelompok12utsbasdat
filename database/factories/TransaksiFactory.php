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
        // Ambil data pembelian yang ada
        $pembelian = Pembelian::inRandomOrder()->first(); // Ambil acak satu pembelian
        $obat = Obat::inRandomOrder()->first(); // Ambil acak obat

        // Ambil NIP apoteker secara acak dan merata
        $nip = Apoteker::inRandomOrder()->first()->NIP; // Mengakses kolom NIP dengan huruf kapital

        // Tentukan no_bpom dan harga
        $noBpom = $obat->no_bpom;
        $hargaSatuan = $obat->harga_satuan;
        $jumlahObat = rand(1, 5); // Jumlah obat yang dibeli (1-5)
        $hargaTotal = $hargaSatuan * $jumlahObat;

        // Jika resep = "Tidak Ada Resep", pastikan obat yang dipilih bukan obat keras
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
        }

        // Gunakan created_at dari pembelian sebagai tanggal transaksi
        $tanggalSekarang = Carbon::parse($pembelian->created_at)->format('Y-m-d'); // Tanggal dari pembelian

        // Generate ID Transaksi (menggunakan format yang baru sesuai keinginan)
        $existingTransactionsCount = Transaksi::whereDate('created_at', $tanggalSekarang)->count(); // Hitung jumlah transaksi pada tanggal yang sama
        $transactionNumber = str_pad($existingTransactionsCount + 1, 3, '0', STR_PAD_LEFT); // Nomor transaksi
        $timestamp = Carbon::parse($pembelian->created_at)->format('YmdHis'); // Timestamp berdasarkan created_at pembelian
        $idTransaksi = 'TR-' . $transactionNumber . '-' . $timestamp; // ID Transaksi unik dengan format yang baru

        // Generate ID Invoice (hanya untuk ID Invoice)
        $existingInvoiceCount = Transaksi::distinct()
            ->whereDate('created_at', $tanggalSekarang)  // Hitung jumlah transaksi pada tanggal yang sama
            ->count('id_invoice');  // Hitung berdasarkan ID Invoice

        // Generate invoice number
        $invoiceNumber = str_pad($existingInvoiceCount + 1, 3, '0', STR_PAD_LEFT); // Nomor invoice
        $idInvoice = 'INV-' . $invoiceNumber . '-' . $timestamp; // ID Invoice (format sama dengan transaksi, hanya diawali "INV-")

        // Tentukan waktu created_at untuk transaksi (ditambah 3-15 menit)
        $createdAtTransaksi = Carbon::parse($pembelian->created_at)->addMinutes(rand(3, 15));

        return [
            'id_transaksi' => $idTransaksi, // ID transaksi unik
            'no_bpom' => $noBpom,
            'id_pembelian' => $pembelian->id_pembelian,
            'id_invoice' => $idInvoice, // ID Invoice
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
