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

        // Generate ID Transaksi (misalnya TR-xxxxxx-yyyyMMddHHmm)
        $idTransaksi = 'TR-' . substr($idPembelian, 3, 6) . '-' . now()->format('YmdHi');

        // Loop melalui setiap obat yang dibeli
        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];

            // Hanya simpan jika jumlah yang dibeli lebih dari 0
            if ($jumlah > 0) {
                // Kurangi stok dari tabel obats
                $obat = Obat::where('no_bpom', $obatId)->first();
                if ($obat) {
                    $obat->stok -= $jumlah;
                    $obat->save(); // Simpan perubahan stok
                }

                // Simpan data transaksi
                Transaksi::create([
                    'id_transaksi' => $idTransaksi, // ID transaksi yang dikustomisasi
                    'id_pembelian' => $idPembelian, // ID Pembelian yang terhubung
                    'nama_obat' => $namaObat,
                    'jumlah_obat' => $jumlah,
                    'harga_satuan' => $hargaSatuan,
                    'harga_total' => $jumlah * $hargaSatuan,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan dengan ID: ' . $idTransaksi);
    }
}
