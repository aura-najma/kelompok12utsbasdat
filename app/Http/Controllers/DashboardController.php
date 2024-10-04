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

        // Pengecekan manual untuk NIP 1 dengan password "katak" atau NIP 2 dengan password "kadal"
        if (($credentials['nip'] === '1' && $credentials['password'] === 'katak') ||
            ($credentials['nip'] === '2' && $credentials['password'] === 'kadal')) {
            
            // Set session secara manual, hanya jika NIP dan password benar
            session(['authenticated_nip' => $credentials['nip']]);

            // Redirect ke halaman dashboard jika berhasil login
            return redirect()->intended('dashboard');
        }

        // Jika gagal login, kembalikan ke form login dengan pesan error
        return back()->withErrors([
            'nip' => 'Nomor Induk Pegawai atau password salah.',
        ])->onlyInput('nip');
    }

    public function logout(Request $request)
    {
        // Hapus session NIP untuk logout
        $request->session()->forget('authenticated_nip');
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }

    public function dashboard()
    {
        // Cek apakah session 'authenticated_nip' ada
        if (session('authenticated_nip')) {
            return view('dashboard'); // Pastikan ada file dashboard.blade.php di folder resources/views
        }

        // Jika session tidak ada, redirect ke halaman login
        return redirect('/login');
    }
}
