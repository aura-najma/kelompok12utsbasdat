<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat; // Pastikan model Obat terimport

class ObatController extends Controller
{
    public function index()
    {
        // Ambil semua data obat dari database
        $obatList = Obat::all(); // Pastikan $obatList berisi data dari model Obat

        // Kirimkan data ke view
        return view('lihatstokobat', compact('obatList'));
    }

    public function tambahStok(Request $request)
    {
        // Validasi data input (pastikan no_bpom dan jumlah stok diberikan)
        $request->validate([
            'no_bpom' => 'required|string',
            'stok' => 'required|integer|min:1',
        ]);
    
        // Temukan obat berdasarkan no_bpom
        $obat = Obat::where('no_bpom', $request->no_bpom)->first();
    
        // Cek apakah obat ditemukan
        if ($obat) {
            // Tambahkan stok obat
            $obat->stok += $request->stok;
            $obat->save();
    
            // Redirect kembali ke /lihatstokobat dengan pesan sukses
            return redirect('/lihatstokobat')->with('message', 'Stok berhasil ditambahkan.');
        } else {
            // Jika obat tidak ditemukan
            return redirect('/lihatstokobat/tambah-stok')->with('message', 'Obat tidak ditemukan.');
        }
    }

    public function tambahObat(Request $request)
    {
        // Validasi data input
        $request->validate([
            'no_bpom' => 'required|string|unique:obats,no_bpom',
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'jenis_obat' => 'required|string',
            'stok' => 'required|integer|min:1',
            'tanggal_kadaluwarsa' => 'required|date',
            'harga_satuan' => 'required|integer|min:1',
            'kategori_obat_keras' => 'nullable|string',
            'dosis' => 'required|string',
            'aturan_pakai' => 'required|string',
            'rute_obat' => 'required|string',
        ]);

        // Simpan data obat baru
        $obat = new Obat();
        $obat->no_bpom = $request->no_bpom;
        $obat->nama = $request->nama;
        $obat->kategori = $request->kategori;
        $obat->jenis_obat = $request->jenis_obat;
        $obat->stok = $request->stok;
        $obat->tanggal_kadaluwarsa = $request->tanggal_kadaluwarsa;
        $obat->harga_satuan = $request->harga_satuan;
        $obat->kategori_obat_keras = $request->kategori_obat_keras;
        $obat->dosis = $request->dosis;
        $obat->aturan_pakai = $request->aturan_pakai;
        $obat->rute_obat = $request->rute_obat;

        $obat->save();

        // Redirect ke /lihatstokobat dengan pesan sukses
        return redirect('/lihatstokobat')->with('message', 'Obat baru berhasil ditambahkan.');
    }


        // Fungsi untuk mengecek stok obat
        public function cekStok(Request $request)
        {
            // Validasi untuk memastikan id_pembelian ada
            $request->validate([
                'id_pembelian' => 'required|string',
            ]);
        
            $idPembelian = $request->query('id_pembelian');
            $obatList = Obat::all();
            dump($idPembelian); // Ini akan menampilkan nilai tetapi melanjutkan eksekusi

            return view('cekstokobat', compact('obatList', 'idPembelian'));
        }

    

}
