<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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

        // Autentikasi user berdasarkan NIP dan password
        if (Auth::attempt(['nip' => $credentials['nip'], 'password' => $credentials['password']])) {
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
