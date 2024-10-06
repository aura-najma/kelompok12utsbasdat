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
            'no_bpom' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jenis_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'tanggal_kadaluwarsa' => 'required|date',
            'harga_satuan' => 'required|integer|min:1',
            'kategori_obat_keras' => 'nullable|string',
            'dosis' => 'required|string',
            'aturan_pakai' => 'required|string',
            'rute_obat' => 'required|string',
        ]);
    
        // Simpan data obat ke database
        Obat::create([
            'no_bpom' => $request->no_bpom,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'jenis_obat' => $request->jenis_obat,
            'stok' => $request->stok,
            'tanggal_kadaluwarsa' => $request->tanggal_kadaluwarsa,
            'harga_satuan' => $request->harga_satuan,
            'kategori_obat_keras' => $request->kategori_obat_keras,
            'dosis' => $request->dosis,
            'aturan_pakai' => $request->aturan_pakai,
            'rute_obat' => $request->rute_obat,
        ]);
    
        return redirect('/lihatstokobat')->with('message', 'Obat berhasil ditambahkan!');
    }
    

    public function showTambahStok()
    {
        // Mengambil data obat dengan stok kurang dari 5
        $lowStockObatList = Obat::where('stok', '<', 5)->get();

        // Mengirimkan data obat dengan stok rendah ke view
        return view('tambahStok', compact('lowStockObatList'));
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

            return view('cekstokobat', compact('obatList', 'idPembelian'));
        }

    

}
