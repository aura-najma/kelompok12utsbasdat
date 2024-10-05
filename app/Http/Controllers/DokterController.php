<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel 'dokter'
        $dokters = DB::table('dokter')->get();
        
        // Cek apakah data sudah diambil dengan benar (sementara, bisa dihapus setelah dicek)
        // dd($dokters);
        
        // Kirim data ke view 'validasidokter'
        return view('validasidokter', ['dokters' => $dokters]);
    }
}
