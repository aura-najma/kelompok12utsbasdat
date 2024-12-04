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
            'id_invoice' => 'required|exists:transaksis,id_invoice',
            'tanggal_transaksi' => 'required|date',
            'evaluasi_apotek' => 'required|string',
            'evaluasi_pelayanan' => 'required|string',
            'evaluasi_obat' => 'required|string',
            'rating_apotek' => 'required|integer|min:1|max:10',
            'komentar' => 'nullable|string',
        ], [
            // Custom error message untuk id_pembeli jika tidak ditemukan
            'id_invoice.exists' => 'ID Invoice salah. Anda belum melakukan pembelian dengan kode tersebut. Cek lagi.'
        ]);
    
        // Cek apakah sudah ada evaluasi dengan id_invoice yang sama
        $existingEvaluasi = Evaluasi::where('id_invoice', $request->input('id_invoice'))->first();
        if ($existingEvaluasi) {
            // Jika sudah ada evaluasi dengan id_invoice tersebut
            return redirect()->back()->with('error', 'Evaluasi untuk ID Invoice ini sudah ada.');
        }
    
        // Ekstrak tanggal dari id_invoice
        $idInvoice = $request->input('id_invoice');
        $tanggalInvoice = substr($idInvoice, 8, 8); // Ambil substring yang berisi tanggal (20241127)
        $tanggalTransaksi = Carbon::parse($request->input('tanggal_transaksi'))->format('Ymd'); // Format tanggal transaksi
    
        // Dump untuk melihat nilai tanggal transaksi dan tanggal dari id_invoice
    
        // Bandingkan tanggal transaksi dengan tanggal yang ada di id_invoice
        if ($tanggalTransaksi !== $tanggalInvoice) {
            // Jika tanggal transaksi tidak sesuai dengan tanggal dari ID Invoice
            return redirect()->back()->with('error', 'Tanggal transaksi tidak sesuai dengan tanggal pada ID Invoice.');
        }
    
        // Generate id_evaluasi
        $tanggalHariIni = Carbon::today()->toDateString();
        $jumlahEvaluasiHariIni = DB::table('evaluasi')
            ->whereDate('created_at', $tanggalHariIni)
            ->count();
    
        // Menggunakan format EV-jumlahEvaluasiHariIni-idPembelian
        $idEvaluasi = 'EV-' . ($jumlahEvaluasiHariIni + 1) . '-' . $idInvoice;
    
        // Simpan data evaluasi
        Evaluasi::create([
            'id_evaluasi' => $idEvaluasi,
            'id_invoice' => $idInvoice,
            'tanggal_transaksi' => $request->input('tanggal_transaksi'),
            'evaluasi_apotek' => $request->input('evaluasi_apotek'),
            'evaluasi_pelayanan' => $request->input('evaluasi_pelayanan'),
            'evaluasi_obat' => $request->input('evaluasi_obat'),
            'rating_apotek' => $request->input('rating_apotek'),
            'komentar' => $request->input('komentar'),
        ]);
    
        // Kembalikan respons ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Evaluasi berhasil disimpan');
    }
    
    
}
