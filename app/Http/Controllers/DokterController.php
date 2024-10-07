<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel dokter
        $dokters = Dokter::all();

        // Kirim data ke view validasidokter.blade.php
        return view('validasidokter', compact('dokters'));
    }

    public function destroy($nomor_str)
    {
        // Cari dokter berdasarkan nomor_str
        $dokter = Dokter::where('nomor_str', $nomor_str)->firstOrFail();
        $dokter->delete();
    
        return redirect()->back()->with('warning', 'Data dokter berhasil dihapus.');
    }
    

}
