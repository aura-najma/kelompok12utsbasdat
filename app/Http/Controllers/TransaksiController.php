<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\Transaksi;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi login
        if (!session('nip')) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        // Ambil NIP apoteker yang login
        $nip = session('nip');

        // Ambil ID Pembelian dari request
        $idPembelian = $request->input('id_pembelian');
        $obats = $request->input('obats', []);
        $tanggalSekarang = now()->format('Y-m-d'); // Tanggal hari ini dalam format Y-m-d

        // Hitung jumlah invoice yang sudah ada untuk hari ini
        $existingInvoiceCount = Transaksi::distinct()
            ->whereDate('created_at', $tanggalSekarang)
            ->count('id_invoice'); // Hitung berdasarkan ID Invoice

        // Generate ID Invoice
        $invoiceNumber = str_pad($existingInvoiceCount + 1, 3, '0', STR_PAD_LEFT);
        $timestamp = now()->format('YmdHis');
        $idInvoice = 'INV-' . $invoiceNumber . '-' . $timestamp;

        // Variabel untuk menghitung nomor transaksi
        $existingTransactionsCount = Transaksi::whereDate('created_at', $tanggalSekarang)->count();

        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];

            if ($jumlah > 0) {
                // Generate nomor transaksi
                $transactionNumber = str_pad($existingTransactionsCount + 1, 3, '0', STR_PAD_LEFT);
                $idTransaksi = 'TR-' . $transactionNumber . '-' . $timestamp;

                $obat = Obat::where('no_bpom', $obatId)->first();

                if ($obat) {
                    if ($obat->stok >= $jumlah) {
                        $obat->stok -= $jumlah;
                        $obat->save();

                        $hargaTotal = $jumlah * $hargaSatuan;

                        // Simpan data transaksi dengan ID Invoice yang sama
                        Transaksi::create([
                            'id_transaksi' => $idTransaksi,
                            'id_pembelian' => $idPembelian,
                            'id_invoice' => $idInvoice, // ID Invoice yang sama untuk semua transaksi dalam pembelian ini
                            'no_bpom' => $obat->no_bpom,
                            'nama_obat' => $namaObat,
                            'jumlah_obat' => $jumlah,
                            'harga_satuan' => $hargaSatuan,
                            'harga_total' => $hargaTotal,
                            'nip' => $nip, // NIP apoteker yang login
                        ]);

                        $existingTransactionsCount++;
                    } else {
                        return redirect()->back()->with('error', 'Stok tidak cukup untuk ' . $namaObat);
                    }
                } else {
                    return redirect()->back()->with('error', 'Obat tidak ditemukan.');
                }
            }
        }

        // Redirect ke halaman invoice.show dengan ID Invoice
        return redirect()->route('invoice.show', ['id_invoice' => $idInvoice]);
    }

    
}