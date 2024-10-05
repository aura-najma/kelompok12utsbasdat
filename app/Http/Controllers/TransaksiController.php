<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Obat;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Ambil ID Pembelian dari request
        $idPembelian = $request->input('id_pembelian');
    
        // Ambil data obat yang dibeli
        $obats = $request->input('obats', []);
        $idTransaksi = 'TR-' . substr($idPembelian, 3, 6) . '-' . now()->format('YmdHi');
    
        // Debugging: Tampilkan ID Pembelian dan ID Transaksi
        dump('ID Pembelian: ' . $idPembelian);
        dump('ID Transaksi: ' . $idTransaksi);
    
        // Loop melalui setiap obat yang dibeli
        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];
    
            // Cek apakah jumlah yang dibeli lebih dari 0
            if ($jumlah > 0) {
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
                            'id_pembelian' => $idPembelian, // Tambahin ini
                            'nama_obat' => $namaObat,
                            'jumlah_obat' => $jumlah,
                            'harga_satuan' => $hargaSatuan,
                            'harga_total' => $jumlah * $hargaSatuan,
                        ]);
                        
    
                        // Debugging: Tampilkan data transaksi yang baru saja disimpan
                        dump($transaksi); // Pastikan data yang disimpan benar
                    } else {
                        return redirect()->back()->with('error', 'Stok tidak cukup untuk ' . $namaObat);
                    }
                } else {
                    return redirect()->back()->with('error', 'Obat tidak ditemukan.');
                }
            }
        }
    
        return redirect()->back()->with('success', 'Transaksi berhasil disimpan dengan ID: ' . $idTransaksi);
    }
    
    
}
