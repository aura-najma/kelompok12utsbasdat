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
    
        // Ambil data obat yang dibeli
        $obats = $request->input('obats', []);

        // Ambil 16 karakter terakhir dari ID Pembelian (atau sesuai kebutuhan)
        $idPembelianSlot = substr($idPembelian, -16);

        // Loop melalui setiap obat yang dibeli
        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];
    
            // Cek apakah jumlah yang dibeli lebih dari 0
            if ($jumlah > 0) {
                // Generate 2 digit UUID baru untuk setiap obat
                $randomDigits = mt_rand(10, 99); // 2 digit angka acak (10-99)
                $idTransaksi = 'TR' . $randomDigits . $idPembelianSlot; // Buat ID Transaksi unik untuk setiap item

                // Debugging: Tampilkan ID Transaksi
                dump('ID Transaksi: ' . $idTransaksi);

                // Ambil obat berdasarkan no_bpom
                $obat = Obat::where('no_bpom', $obatId)->first();
                
                // Cek apakah obat ada dan stok cukup
                if ($obat) {
                    if ($obat->stok >= $jumlah) { // Pastikan stok cukup
                        $obat->stok -= $jumlah; // Kurangi stok
                        $obat->save(); // Simpan perubahan stok
    
                        // Simpan data transaksi
                        $transaksi = Transaksi::create([
                            'id_transaksi' => $idTransaksi,
                            'id_pembelian' => $idPembelian, 
                            'nama_obat' => $namaObat,
                            'jumlah_obat' => $jumlah,
                            'harga_satuan' => $hargaSatuan,
                            'harga_total' => $jumlah * $hargaSatuan,
                        ]);
                        
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
