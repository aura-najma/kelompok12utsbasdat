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
            'id_invoice' => 'required|exists:transaksis,id_invoice',  // Perubahan di sini
            'tanggal_transaksi' => 'required|date',
            'evaluasi_apotek' => 'required|string',
            'evaluasi_pelayanan' => 'required|string',
            'evaluasi_obat' => 'required|string',
            'rating_apotek' => 'required|integer|min:1|max:10',
            'komentar' => 'nullable|string',
        ], [
            'id_invoice.exists' => 'ID Invoice salah atau belum terdaftar di transaksi. Pastikan ID Pembelian sesuai.'
        ]);        

        // Generate id_evaluasi
        $tanggalHariIni = Carbon::today()->toDateString();
        $jumlahEvaluasiHariIni = DB::table('evaluasi')
            ->whereDate('created_at', $tanggalHariIni)
            ->count();

        // Menggunakan format EV-jumlahEvaluasiHariIni-idPembelian
        $idEvaluasi = 'EV-' . ($jumlahEvaluasiHariIni + 1) . '-' . $request->input('id_invoice');

        // Simpan data evaluasi
        Evaluasi::create([
            'id_evaluasi' => $idEvaluasi,
            'id_invoice' => $request->input('id_invoice'),
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
            'evaluasi_apotek' => $request->input('evaluasi_apotek'),
            'evaluasi_pelayanan' => $request->input('evaluasi_pelayanan'),
            'evaluasi_obat' => $request->input('evaluasi_obat'),
            'rating_apotek' => $request->input('rating_apotek'),
            'komentar' => $request->input('komentar'),
        ]);

        // Mengembalikan respons ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Evaluasi berhasil disimpan');
    }
}
