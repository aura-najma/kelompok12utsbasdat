<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\RestockObat;
use App\Models\Pembelian;
use App\Models\Pasien;

class ObatController extends Controller
{
    // Menampilkan daftar stok obat
    public function index()
    {
        // Ambil semua data obat dari database
        $obatList = Obat::all(); // Pastikan $obatList berisi data dari model Obat

        // Kirimkan data ke view
        return view('lihatstokobat', compact('obatList'));
    }

    // Menambahkan stok obat
    public function tambahStok(Request $request)
    {
        // Validasi data input (pastikan no_bpom dan jumlah stok diberikan)
        $request->validate([
            'no_bpom' => 'required|string',
            'stok' => 'required|integer|min:1',
            'tanggal_kadaluwarsa' => 'required|date',  // Pastikan tanggal kadaluarsa juga diberikan
        ]);
    
        // Temukan obat berdasarkan no_bpom
        $obat = Obat::where('no_bpom', $request->no_bpom)->first();
    
        // Cek apakah obat ditemukan
        if ($obat) {
            // Generate id_restock dengan format RS-YYYYMMDD-no_bpom
            $idRestock = 'RS-' . date('Ymd') . '-' . $obat->no_bpom;

            // Tambahkan data ke tabel restock_obat
            RestockObat::create([
                'id_restock' => $idRestock,  // id_restock dengan format yang telah ditentukan
                'no_bpom' => $obat->no_bpom,
                'jumlah' => $request->stok,
                'tanggal_kadaluwarsa' => $request->tanggal_kadaluwarsa,
            ]);
    
            // Tambahkan stok ke obat
            $obat->stok += $request->stok;
            $obat->save();
    
            // Redirect kembali ke /lihatstokobat dengan pesan sukses
            return redirect('/lihatstokobat')->with('message', 'Stok berhasil ditambahkan.');
        } else {
            // Jika obat tidak ditemukan
            return redirect('/lihatstokobat/tambah-stok')->with('message', 'Obat tidak ditemukan.');
        }
    }

    // Menampilkan halaman untuk menambah obat
    public function showTambahObat()
    {
        return view('tambahObat');
    }

    // Menambahkan obat baru
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
    
        // Cek apakah no_bpom sudah ada di database
        $existingObat = Obat::where('no_bpom', $request->no_bpom)->first();
        if ($existingObat) {
            // Jika no_bpom sudah ada, kembalikan ke halaman sebelumnya dengan notifikasi error
            return redirect('/lihatstokobat')->with('error', 'No BPOM ' . $existingObat->no_bpom . ' sudah ada, silakan akses halaman Tambah Stok Obat.');
        }

        // Simpan data obat ke database jika no_bpom belum ada
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
    
        // Kembali ke halaman lihat stok obat dengan pesan sukses
        return redirect('/lihatstokobat')->with('message', 'Obat berhasil ditambahkan!');
    }

    // Menampilkan halaman untuk menambah stok obat
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
    
        // Ambil id_pembelian dari request
        $idPembelian = $request->query('id_pembelian');
    
        // Ambil data pembelian berdasarkan id_pembelian
        $pembelian = Pembelian::where('id_pembelian', $idPembelian)->first();
    
        if ($pembelian) {
            // Ambil no_telepon dari pembelian
            $noTelepon = $pembelian->no_telepon;
    
            // Ambil data pasien berdasarkan no_telepon
            $pasien = Pasien::where('no_telepon', $noTelepon)->first();
    
            // Ambil alergi_obat dari pasien
            $alergiObat = $pasien ? $pasien->alergi_obat : null;
        } else {
            $alergiObat = null;
        }
    
        // Ambil semua data obat
        $obatList = Obat::all();
    
        return view('cekstokobat', compact('obatList', 'idPembelian', 'alergiObat'));
    }
}
