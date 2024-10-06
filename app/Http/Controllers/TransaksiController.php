<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\Transaksi;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function cekStok(Request $request)
    {
        // Ambil ID Pembelian dari query parameter
        $idPembelian = $request->input('id_pembelian');
        
        // Log untuk melihat nilai idPembelian
        Log::info('Nilai idPembelian:', ['idPembelian' => $idPembelian]);
    
        // Ambil no_telepon dari tabel pembelians berdasarkan id_pembelian
        $pembelian = Pembelian::where('id_pembelian', $idPembelian)->first();
        $noTelepon = $pembelian ? $pembelian->no_telepon : null;
    
        // Log untuk melihat nilai noTelepon
        Log::info('Nilai noTelepon:', ['noTelepon' => $noTelepon]);
    
        $alergiObat = null;
        if ($noTelepon) {
            $pasien = Pasien::where('no_telepon', $noTelepon)->first();
            if ($pasien) {
                $alergiObat = $pasien->alergi_obat;
            }
        }
    
        // Log untuk melihat nilai alergiObat
        Log::info('Nilai alergiObat:', ['alergiObat' => $alergiObat]);
    
        // Ambil data obat yang ada di stok
        $obatList = Obat::all();
        
        // Log untuk melihat data obat
        Log::info('Data Obat:', ['obatList' => $obatList->toArray()]);
    
        // Kirim data ke view
        return view('cekstokobat', [
            'obatList' => $obatList,
            'idPembelian' => $idPembelian,
            'alergiObat' => $alergiObat,
        ]);
    }
    
    

    public function store(Request $request)
    {
        // Ambil ID Pembelian dari request
        $idPembelian = $request->input('id_pembelian');
        $obats = $request->input('obats', []);
        $tanggalSekarang = now()->format('Y-m-d'); // Tanggal hari ini dalam format Y-m-d

        // Ambil jumlah transaksi yang sudah ada untuk ID Pembelian pada tanggal hari ini
        $existingTransactionsCount = Transaksi::whereDate('created_at', $tanggalSekarang)->count();

        foreach ($obats as $obatId => $data) {
            $jumlah = $data['jumlah'];
            $hargaSatuan = $data['harga_satuan'];
            $namaObat = $data['nama'];

            if ($jumlah > 0) {
                // Generate nomor urut berdasarkan jumlah transaksi yang sudah ada pada hari ini
                $transactionNumber = str_pad($existingTransactionsCount + 1, 3, '0', STR_PAD_LEFT);
                $timestamp = now()->format('YmdHis'); // Timestamp saat ini dalam format YmdHis
                $idTransaksi = 'TR-' . $transactionNumber . '-' . $timestamp;

                // Ambil obat berdasarkan no_bpom
                $obat = Obat::where('no_bpom', $obatId)->first();

                if ($obat) {
                    if ($obat->stok >= $jumlah) {
                        $obat->stok -= $jumlah;
                        $obat->save();

                        // Hitung harga total untuk obat ini
                        $hargaTotal = $jumlah * $hargaSatuan;

                        // Simpan data transaksi
                        Transaksi::create([
                            'id_transaksi' => $idTransaksi,
                            'id_pembelian' => $idPembelian,
                            'no_bpom' => $obat->no_bpom,
                            'nama_obat' => $namaObat,
                            'jumlah_obat' => $jumlah,
                            'harga_satuan' => $hargaSatuan,
                            'harga_total' => $hargaTotal,
                        ]);

                        // Increment untuk transaksi berikutnya dalam loop
                        $existingTransactionsCount++;
                    } else {
                        return redirect()->back()->with('error', 'Stok tidak cukup untuk ' . $namaObat);
                    }
                } else {
                    return redirect()->back()->with('error', 'Obat tidak ditemukan.');
                }
            }
        }

        return redirect()->route('invoice.show', ['id_pembelian' => $idPembelian]);
    }
}
