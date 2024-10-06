<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaksi;
use App\Models\Obat;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Membuat dan menampilkan halaman invoice berdasarkan ID Pembelian.
     */
    public function show(Request $request)
    {
        // Ambil ID Pembelian dari query parameter
        $idPembelian = $request->query('id_pembelian');

        // Ambil data transaksi berdasarkan ID Pembelian
        $transaksiData = Transaksi::where('id_pembelian', $idPembelian)->get();

        // Jika tidak ada transaksi, redirect dengan pesan error
        if ($transaksiData->isEmpty()) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        // Hitung total harga keseluruhan dari semua transaksi
        $totalHarga = $transaksiData->sum('harga_total');

        // Ambil created_at dari salah satu transaksi untuk digunakan sebagai tanggal pembuatan
        $created_at = $transaksiData->first()->created_at;

        // Siapkan data untuk view dan mengelompokkan berdasarkan no_bpom
        $transaksiDataGrouped = $transaksiData->groupBy('no_bpom');
        $invoiceData = [];

        foreach ($transaksiDataGrouped as $noBpom => $items) {
            $totalJumlah = $items->sum('jumlah_obat');
            $totalHargaObat = $items->sum('harga_total');
            $firstItem = $items->first(); // Ambil item pertama untuk data umum

            // Ambil dosis dan aturan pakai dari tabel `obats` berdasarkan `no_bpom`
            $obat = Obat::where('no_bpom', $noBpom)->first();
            $dosis = $obat ? $obat->dosis : null;
            $aturanPakai = $obat ? $obat->aturan_pakai : null;

            // Mengisi data untuk invoice
            $invoiceData[] = [
                'no_bpom' => $noBpom,
                'nama_obat' => $firstItem->nama_obat,
                'jumlah_obat' => $totalJumlah,
                'harga_satuan' => $firstItem->harga_satuan,
                'harga_total' => $totalHargaObat,
                'dosis' => $dosis,
                'aturan_pakai' => $aturanPakai,
                'created_at' => $created_at,
            ];
        }

        // Tampilkan halaman invoice
        return view('invoicetransaksi', [
            'transaksiData' => $invoiceData,
            'idPembelian' => $idPembelian,
            'totalHarga' => $totalHarga,
            'created_at' => $created_at,
        ]);
    }
}
