<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Ambil ID Pembelian dari request
        $idPembelian = $request->input('id_pembelian');
        $obats = $request->input('obats', []);
        $tanggalSekarang = now()->format('Y-m-d'); // Tanggal hari ini dalam format Y-m-d
        
        // Ambil jumlah transaksi yang sudah ada untuk ID Pembelian pada tanggal hari ini
        $existingTransactionsCount = Transaksi::whereDate('created_at', $tanggalSekarang)->count();
        
        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];
    
            if ($jumlah > 0) {
                // Generate nomor urut berdasarkan jumlah transaksi yang sudah ada pada hari ini
                $transactionNumber = str_pad($existingTransactionsCount + 1, 3, '0', STR_PAD_LEFT);
                $timestamp = now()->format('YmdHis'); // timestamp saat ini dalam format YmdHis
                $idTransaksi = 'TR-' . $transactionNumber . '-' . $timestamp; // Tambahkan tanda strip
    
                // Debugging: Tampilkan ID Transaksi
                dump('ID Transaksi: ' . $idTransaksi);
    
                // Ambil obat berdasarkan no_bpom
                $obat = Obat::where('no_bpom', $obatId)->first();
    
                if ($obat) {
                    if ($obat->stok >= $jumlah) {
                        $obat->stok -= $jumlah;
                        $obat->save();
    
                        // Simpan data transaksi
                        Transaksi::create([
                            'id_transaksi' => $idTransaksi,
                            'id_pembelian' => $idPembelian,
                            'nama_obat' => $namaObat,
                            'jumlah_obat' => $jumlah,
                            'harga_satuan' => $hargaSatuan,
                            'harga_total' => $jumlah * $hargaSatuan,
                        ]);
    
                        // Increment untuk transaksi berikutnya dalam loop
                        $existingTransactionsCount++;
                    } else {
                        return redirect()->back()->with('error', 'Stok tidak cukup untuk ' . $namaObat);
                    }
                } else {
                    return redirect()->back()->with('error', 'Obat tidak ditemukan.');
                }
            }
        }
    
        return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');
    }
    
    
    
}
