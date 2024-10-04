<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi; // Model Evaluasi harus dibuat

class EvaluasiController extends Controller
{
    public function create()
    {
        return view('evaluasi');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_pembeli' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
            'evaluasi_apotek' => 'required|string',
            'evaluasi_pelayanan' => 'required|string',
            'evaluasi_obat' => 'required|string',
            'rating_apotek' => 'required|integer|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        // Simpan ke database
        Evaluasi::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('evaluasi.create')->with('success', 'Evaluasi berhasil disimpan.');
    }
}
