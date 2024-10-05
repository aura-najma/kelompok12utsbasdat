<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;

class TransaksiController extends Controller
{
    public function cekstok()
    {
        // Ambil semua data obat dari database
        $obatList = Obat::all();

        // Kirim data obat ke view
        return view('cekstokobat', compact('obatList'));
    }

    public function checkout(Request $request)
    {
        // Dapatkan `new_id` dari session atau request
        $newId = $request->session()->get('new_id'); // Sesuaikan sesuai aplikasi Anda

        // Buat `id_transaksi` sekali untuk seluruh transaksi
        $newIdShort = substr($newId, 0, 6); // Ambil 6 karakter pertama dari `new_id`
        $timestamp = now()->format('ymdHi'); // Ambil `YYMMDDHHMM`
        $idTransaksi = 'TR-' . $newIdShort . $timestamp; // Buat ID transaksi

        // Looping melalui setiap obat yang dipilih
        foreach ($request->quantities as $obatId => $quantity) {
            if ($quantity > 0) {
                // Dapatkan informasi obat
                $obat = Obat::find($obatId);
                $namaObat = $request->names[$obatId];
                $hargaSatuan = $request->prices[$obatId];
                $hargaTotal = $quantity * $hargaSatuan;

                // Periksa stok yang mencukupi
                if ($obat->stok < $quantity) {
                    return redirect()->back()->with('error', 'Stok obat tidak mencukupi untuk ' . $namaObat);
                }

                // Simpan data transaksi
                Transaksi::create([
                    'id_transaksi' => $idTransaksi, // ID yang sama untuk semua obat dalam transaksi ini
                    'new_id' => $newId,
                    'nama_obat' => $namaObat,
                    'jumlah' => $quantity,
                    'harga_satuan' => $hargaSatuan,
                    'harga_total' => $hargaTotal,
                ]);

                // Perbarui stok obat
                $obat->stok -= $quantity;
                $obat->save();
            }
        }

        return redirect()->route('checkoutobat')->with('success', 'Transaksi berhasil disimpan.');
    }
}
