<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pembelian;
use Illuminate\Support\Str;


class PasienController extends Controller
{
    // Fungsi untuk menampilkan halaman form pasien
    public function index()
    {
        return view('inputpasien');
    }
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
                // Resep bersifat nullable
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
            if ($request->hasFile('resep')) {
                $resepPath = $request->file('resep')->store('resep', 'public');
            }

            // Generate `new_id`
            $newId = 'PB-' . substr($request->no_telepon, -4) . '-' . now()->format('YmdHi');

            // Simpan data pembelian
            $pembelian = Pembelian::create([
                'new_id' => $newId, // Set new_id sesuai dengan kebutuhan
                'no_telepon' => $request->no_telepon,
                'keluhan' => $request->keluhan,
                'resep' => $resepPath, // Nilai bisa `null` jika tidak ada resep
            ]);
                    // Redirect berdasarkan apakah file `resep` ada atau tidak
            if ($resepPath) {
                return redirect('/cekobatkeras')->with('success', 'Data pasien dan pembelian berhasil disimpan.');
            } else {
                return redirect('/cekstokobat')->with('success', 'Data pasien dan pembelian berhasil disimpan.');
            }
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }
    

    public function getPasien(Request $request)
    {
        // Ambil `no_telepon` dari request
        $noTelepon = $request->query('no_telepon');

        // Cari data pasien berdasarkan `no_telepon`
        $pasien = Pasien::where('no_telepon', $noTelepon)->first();

        // Kembalikan data pasien dalam format JSON
        return response()->json($pasien);
    }

    public function listPasien()
    {
        // Ambil semua data pasien dari database
        $pasienList = Pasien::all();
    
        // Kirim data pasien ke view
        return view('daftarPasien', compact('pasienList'));
    }

}
