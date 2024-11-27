<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Apoteker;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Menampilkan halaman invoice berdasarkan ID Invoice.
     */
    public function show(Request $request)
    {
        // Ambil ID Invoice dari query parameter
        $idInvoice = $request->query('id_invoice');

        // Ambil data transaksi berdasarkan ID Invoice
        $transaksiData = Transaksi::with(['apoteker', 'obat'])
            ->where('id_invoice', $idInvoice)
            ->get();

        // Jika tidak ada transaksi, redirect dengan pesan error
        if ($transaksiData->isEmpty()) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        // Ambil informasi dari transaksi pertama (tanggal pembuatan)
        $firstTransaction = $transaksiData->first();
        $tanggalTransaksi = $firstTransaction->created_at;

        // Ambil informasi apoteker yang melayani berdasarkan NIP
        $nip = $firstTransaction->nip;
        $apoteker = Apoteker::where('NIP', $nip)->first();
        $namaApoteker = $apoteker ? $apoteker->user : 'Tidak Diketahui';

        // Hitung total harga keseluruhan dari semua transaksi
        $totalHarga = $transaksiData->sum('harga_total');

        // Siapkan data untuk view
        $invoiceData = []; // Inisialisasi array kosong

        foreach ($transaksiData as $transaksi) {
            $obat = $transaksi->obat; // Ambil data obat melalui relasi
            $invoiceData[] = [
                'no_bpom' => $transaksi->no_bpom,
                'nama_obat' => $transaksi->nama_obat,
                'jumlah_obat' => $transaksi->jumlah_obat,
                'harga_satuan' => $transaksi->harga_satuan,
                'harga_total' => $transaksi->harga_total,
                'dosis' => $obat->dosis ?? 'Tidak Diketahui',
                'aturan_pakai' => $obat->aturan_pakai ?? 'Tidak Diketahui',
            ];
        }

        // Tampilkan halaman invoice
        return view('invoicetransaksi', [
            'idInvoice' => $idInvoice,
            'tanggalTransaksi' => $tanggalTransaksi,
            'namaApoteker' => $namaApoteker,
            'transaksiData' => $invoiceData,
            'totalHarga' => $totalHarga,
        ]);
    }
}
