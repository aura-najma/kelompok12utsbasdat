<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showLoginForm()
    {
        // Menampilkan form login
        return view('login'); // Pastikan ada file login.blade.php di folder resources/views
    }

    public function login(Request $request)
    {
        // Validasi input NIP dan password
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Pengecekan manual NIP dan password yang valid
        if (($credentials['nip'] == '1' && $credentials['password'] == 'katak') ||
            ($credentials['nip'] == '2' && $credentials['password'] == 'kadal')) {
            
            // Set session atau autentikasi manual
            Auth::loginUsingId($credentials['nip']);

            // Redirect ke halaman dashboard jika berhasil login
            return redirect()->intended('dashboard');
        }

        // Kembali ke halaman login jika gagal
        return back()->withErrors([
            'nip' => 'Nomor Induk Pegawai atau password salah.',
        ])->onlyInput('nip');
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
}
