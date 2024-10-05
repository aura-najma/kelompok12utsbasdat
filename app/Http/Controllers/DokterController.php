<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jangan lupa impor DB facade

class DokterController extends Controller
{
    public function index()
    {
        $dokters = DB::table('dokter')->get();
        dd($dokters); // Ini akan menampilkan data di layar
        return view('validasidokter', ['dokters' => $dokters]);
    }    
    
}
