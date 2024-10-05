<?php

namespace App\Http\Controllers;
use App\Models\Apoteker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada
class DashboardController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    
        // Mengambil data apoteker berdasarkan NIP
        $apoteker = Apoteker::where('nip', $credentials['nip'])->first();
    
        // Verifikasi NIP dan Password
        if ($apoteker && Hash::check($credentials['password'], $apoteker->password)) {
            // Simpan informasi pengguna ke dalam session
            session(['user' => $apoteker->nama]);
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

    return view('dashboardutama', compact('user'));
}

}
