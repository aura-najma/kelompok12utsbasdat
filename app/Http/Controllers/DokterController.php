<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // Pastikan Anda mengimpor DB facade

class DokterController extends Controller
{

    public function index()
{
    $dokters = DB::table('dokter')->get();
    dd($dokters); // Ini akan memeriksa apakah $dokters sudah ada isinya
    return view('validasidokter', ['dokters' => $dokters]);
}

}
