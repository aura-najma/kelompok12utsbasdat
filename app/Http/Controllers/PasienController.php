<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pembelian;
use Illuminate\Support\Str;


class PasienController extends Controller
{
    // Fungsi untuk menampilkan halaman form pasien
    public function store(Request $request)
    {
        try {
            // Validasi data input
            $request->validate([
                'no_telepon' => 'required|string|max:15',
                'nama' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'keluhan' => 'required|string',
                'resep' => 'nullable|file|mimes:jpeg,jpg,png|max:2048',
            ]);
    
            // Simpan data pasien
            $pasien = Pasien::firstOrNew(['no_telepon' => $request->no_telepon]);
            $pasien->nama = $request->nama;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->alamat = $request->alamat;
            $pasien->alergi_obat = $request->alergi_obat;
            $pasien->save();
    
            // Simpan file resep yang di-upload (jika ada)
            $resepPath = null;
            $hasResep = false;
            if ($request->hasFile('resep')) {
                $resepPath = $request->file('resep')->store('resep', 'public');
                $hasResep = true;
            }
    
            // Generate `id_pembelian`
            $idPembelian = 'PB-' . substr($request->no_telepon, -4) . '-' . now()->format('YmdHi');
    
            // Simpan data pembelian
            Pembelian::create([
                'id_pembelian' => $idPembelian,
                'no_telepon' => $request->no_telepon,
                'keluhan' => $request->keluhan,
                'resep' => $resepPath,
            ]);
    
            // Kembalikan response JSON jika berhasil
            return response()->json(['success' => true, 'id_pembelian' => $idPembelian, 'has_resep' => $hasResep]);
    
        } catch (\Exception $e) {
            // Kembalikan response JSON jika terjadi error
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    


    public function getPasienByNoTelepon(Request $request)
    {
        $noTelepon = $request->input('no_telepon');
        $pasien = Pasien::where('no_telepon', $noTelepon)->first();

        if ($pasien) {
            return response()->json(['success' => true, 'pasien' => $pasien]);
        } else {
            return response()->json(['success' => false, 'message' => 'Pasien tidak ditemukan.']);
        }
    }


    public function listPasien()
    {
        // Ambil semua data pasien dari database
        $pasienList = Pasien::all();
    
        // Kirim data pasien ke view
        return view('daftarPasien', compact('pasienList'));
    }

    public function edit($no_telepon)
    {
        $pasien = Pasien::where('no_telepon', $no_telepon)->firstOrFail();
        return view('editPasien', compact('pasien'));
    }

    public function update(Request $request, $no_telepon)
    {
        $pasien = Pasien::where('no_telepon', $no_telepon)->firstOrFail();
        $pasien->update($request->all());
        return redirect()->route('daftarPasien')->with('success', 'Data pasien berhasil diubah.');
    }






}
