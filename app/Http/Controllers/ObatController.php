<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat; // Pastikan model Obat terimport

class ObatController extends Controller
{
    public function index()
    {
        // Ambil semua data obat dari database
        $obatList = Obat::all(); // Pastikan $obatList berisi data dari model Obat

        // Kirimkan data ke view
        return view('lihatstokobat', compact('obatList'));
    }
}
