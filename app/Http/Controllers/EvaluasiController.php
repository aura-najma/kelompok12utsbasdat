<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EvaluasiController extends Controller
{
    // Menyimpan evaluasi baru ke database
    public function store(Request $request)
    {
        // Validasi input yang diperlukan
        $request->validate([
            'id_pembeli' => 'required|exists:pembelians,id_pembelian',
            'tanggal_transaksi' => 'required|date',
            'evaluasi_apotek' => 'required|string',
            'evaluasi_pelayanan' => 'required|string',
            'evaluasi_obat' => 'required|string',
            'rating_apotek' => 'required|integer|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        // Generate id_evaluasi
        $tanggalHariIni = Carbon::today()->toDateString();
        $jumlahEvaluasiHariIni = DB::table('evaluasi')
            ->whereDate('created_at', $tanggalHariIni)
            ->count();

        // Menggunakan format EV-jumlahEvaluasiHariIni-idPembelian
        $idEvaluasi = 'EV-' . ($jumlahEvaluasiHariIni + 1) . '-' . $request->input('id_pembeli');

        // Simpan data evaluasi
        Evaluasi::create([
            'id_evaluasi' => $idEvaluasi,
            'id_pembeli' => $request->input('id_pembeli'),
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
            'evaluasi_apotek' => $request->input('evaluasi_apotek'),
            'evaluasi_pelayanan' => $request->input('evaluasi_pelayanan'),
            'evaluasi_obat' => $request->input('evaluasi_obat'),
            'rating_apotek' => $request->input('rating_apotek'),
            'komentar' => $request->input('komentar'),
        ]);

        // Mengembalikan respons tanpa pengalihan halaman
        return redirect()->back()->with('success', 'Evaluasi berhasil disimpan');
    }
}

