<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Menggunakan DB untuk query database
use Illuminate\Support\Facades\Hash; // Menggunakan Hash untuk mengecek password

class DashboardController extends Controller
{
    public function showLoginForm()
    {
        // Menampilkan form login
        return view('login'); // Pastikan ada file login.blade.php di folder resources/views
    }

    public function login(Request $request)
    {
        // Validasi input yang diperlukan
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        
        // Verifikasi NIP dan Password
        $apoteker = DB::table('apoteker')->where('NIP', $credentials['nip'])->first();
        if ($apoteker && Hash::check($credentials['password'], $apoteker->password)) {
            // Simpan NIP dan nama pengguna ke dalam session
            session(['nip' => $apoteker->NIP]);
            session(['user' => $apoteker->user]);
        
            // Redirect ke dashboard utama setelah berhasil login
            return redirect()->route('dashboardutama');
        }

        // Kembali ke halaman login dengan pesan kesalahan jika NIP atau password salah
        return back()->withErrors([
            'nip' => 'NIP atau password salah.',
        ])->onlyInput('nip');
    }

    public function logout(Request $request)
    {
        // Menghapus semua data dari session untuk logout
        session()->flush();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }

    public function dashboard()
    {
        // Ambil nama pengguna dari session
        $user = session('user');

        // Jika tidak ada user di session, redirect ke halaman login
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'Anda harus login terlebih dahulu']);
        }

        // Tampilkan halaman dashboard utama dengan nama pengguna
        return view('dashboardutama', compact('user'));
    }
}
