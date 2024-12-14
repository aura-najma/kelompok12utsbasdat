<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkemaEvaluasiController extends Controller
{
    public function index()
    {
        // Anda bisa mengirimkan data ke view jika diperlukan
        $user = auth()->user()->name;  // Mengambil nama pengguna yang sedang login
        return view('skema_pendapatan', compact('user'));
    }
}
