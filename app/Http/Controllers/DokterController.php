<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // Pastikan Anda mengimpor DB facade

class DokterController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel dokter
        $dokters = DB::table('dokter')->get();

        // Mengirim data dokter ke view validasidokter.blade.php
        return view('validasidokter', ['dokters' => $dokters]);
    }
}
