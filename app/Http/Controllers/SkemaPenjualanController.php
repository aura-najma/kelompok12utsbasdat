<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Anda bisa mengirimkan data ke view jika diperlukan
        $user = auth()->user()->name;  // Mengambil nama pengguna yang sedang login
        return view('skema_penjualan', compact('user'));
    }
    /**
     * Fungsi untuk mengambil data evaluasi apotek per bulan
     */
    public function evaluasiApotek(Request $request)
    {
        $bulan = $request->input('bulan'); // Ambil filter bulan dari request
        $query = DB::table('evaluasi')
            ->selectRaw('MONTH(tanggal_transaksi) as bulan, AVG(evaluasi_apotek) as rata_rata')
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($bulan) {
            $query->whereMonth('tanggal_transaksi', $bulan);
        }

        $data = $query->get();
        return response()->json($data);
    }

    /**
     * Fungsi untuk mengambil data evaluasi obat per bulan
     */
    public function evaluasiObat(Request $request)
    {
        $bulan = $request->input('bulan');
        $query = DB::table('evaluasi')
            ->selectRaw('MONTH(tanggal_transaksi) as bulan, AVG(evaluasi_obat) as rata_rata')
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($bulan) {
            $query->whereMonth('tanggal_transaksi', $bulan);
        }

        $data = $query->get();
        return response()->json($data);
    }

    /**
     * Fungsi untuk mengambil data evaluasi pelayanan per bulan
     */
    public function evaluasiPelayanan(Request $request)
    {
        $bulan = $request->input('bulan');
        $query = DB::table('evaluasi')
            ->selectRaw('MONTH(tanggal_transaksi) as bulan, AVG(evaluasi_pelayanan) as rata_rata')
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($bulan) {
            $query->whereMonth('tanggal_transaksi', $bulan);
        }

        $data = $query->get();
        return response()->json($data);
    }

    /**
     * Fungsi untuk mengambil data evaluasi pelayanan berdasarkan apoteker
     */
    public function evaluasiPelayananByApoteker()
    {
        $data = DB::table('evaluasi')
            ->join('apoteker', 'evaluasi.id_apoteker', '=', 'apoteker.id_apoteker')
            ->selectRaw('apoteker.nama as apoteker, AVG(evaluasi_pelayanan) as rata_rata')
            ->groupBy('apoteker.nama')
            ->orderBy('rata_rata', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Fungsi untuk mengambil data evaluasi pelayanan berdasarkan tipe pelayanan
     */
    public function evaluasiByTipePelayanan()
    {
        $data = DB::table('evaluasi')
            ->join('dim_tipe_evaluasi', 'evaluasi.id_tipe_evaluasi', '=', 'dim_tipe_evaluasi.id_tipe_evaluasi')
            ->selectRaw('dim_tipe_evaluasi.nama_tipe_evaluasi as tipe_pelayanan, AVG(evaluasi_pelayanan) as rata_rata')
            ->groupBy('dim_tipe_evaluasi.nama_tipe_evaluasi')
            ->orderBy('rata_rata', 'desc')
            ->get();

        return response()->json($data);
    }
}

