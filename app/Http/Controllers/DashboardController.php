<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Aturan login ketat untuk NIP dan password
        if ($request->nip == '1' && $request->password == 'katak' || $request->nip == '2' && $request->password == 'kupu') {
            return redirect()->route('dashboard'); // Pastikan redirect ke dashboard
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
