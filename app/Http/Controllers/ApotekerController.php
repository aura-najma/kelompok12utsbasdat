<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_registrasi' => 'required|string',
            'password' => 'required|string|email',
        ]);

        // Mencari apoteker berdasarkan nomor registrasi
        $apoteker = Apoteker::where('no_registrasi_apoteker', $request->nomor_registrasi)->first();

        // Cek apakah apoteker ditemukan dan password sesuai
        if ($apoteker && $apoteker->email === $request->password) {
            // Set session untuk autentikasi
            Auth::login($apoteker);

            // Redirect ke dashboard utama setelah login
            return redirect()->route('dashboardutama');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors([
            'message' => 'Nomor Registrasi atau Password salah',
        ]);
    }
}


