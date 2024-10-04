<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;

class EvaluasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'id_pembeli' => 'required|string',
            'tanggal_transaksi' => 'required|date',
            'evaluasi_apotek' => 'required|string',
            'evaluasi_pelayanan' => 'required|string',
            'evaluasi_obat' => 'required|string',
            'rating_apotek' => 'required|integer|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        // Simpan data ke database
        Evaluasi::create([
            'id_pembeli' => $request->id_pembeli,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'evaluasi_apotek' => $request->evaluasi_apotek,
            'evaluasi_pelayanan' => $request->evaluasi_pelayanan,
            'evaluasi_obat' => $request->evaluasi_obat,
            'rating_apotek' => $request->rating_apotek,
            'komentar' => $request->komentar,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Evaluasi berhasil dikirim!');
    }
}
