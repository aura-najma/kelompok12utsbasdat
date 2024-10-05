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
}
