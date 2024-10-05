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
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    
        // Verifikasi NIP dan Password
        if (($credentials['nip'] == '1' && $credentials['password'] == 'katak') || 
            ($credentials['nip'] == '2' && $credentials['password'] == 'kupu')) {
    
            // Simpan informasi pengguna ke dalam session
            if ($credentials['nip'] == '1') {
                session(['user' => 'Dyah Ayu']);
            } elseif ($credentials['nip'] == '2') {
                session(['user' => 'Aura Najma']);
            }
    
            return redirect()->route('dashboardutama');
        }
    
        return back()->withErrors([
            'nip' => 'NIP atau password salah.',
        ])->onlyInput('nip');
    }
    

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
    public function dashboard()
{
    // Ambil nama pengguna dari session
    $user = session('user');

    return view('dashboard', compact('user'));
}

}
