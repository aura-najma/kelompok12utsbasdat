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
    // Validasi NIP dan password
    if ($request->nip == 1 && $request->password == 'katak') {
        $user = 'Dyah Ayu';
    } elseif ($request->nip == 2 && $request->password == 'kupu') {
        $user = 'Aura Najma';
    } else {
        // Tangani jika NIP atau password salah
        return back()->withErrors(['message' => 'NIP atau password salah']);
    }

    // Simpan user ke session
    session(['user' => $user]);

    return redirect()->route('dashboardutama');
    }
    

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
    public function dashboardutama()
    {
        // Ambil nama pengguna dari session
        $user = session('user');
    
        // Periksa jika user tidak ada di session
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'Anda harus login terlebih dahulu']);
        }
    
        return view('dashboardutama', compact('user'));
    }
    
    

}
