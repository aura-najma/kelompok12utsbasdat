<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada
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
        $apoteker = DB::table('apoteker')->where('NIP', $credentials['nip'])->first();
    
        if ($apoteker && Hash::check($credentials['password'], $apoteker->password)) {
            // Simpan NIP dan nama pengguna ke dalam session
            session(['nip' => $apoteker->NIP]);
            session(['user' => $apoteker->user]);
    
            // Debugging untuk memastikan data tersimpan
            dd(session()->all()); // Ini akan menampilkan semua data di session
    
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
