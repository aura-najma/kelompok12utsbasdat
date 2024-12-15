<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FactPenjualanObatWilayah;
use App\Models\FactPenjualanPendapatan;
use App\Models\DimKategoriObat;
use App\Models\DimWilayah;
use App\Models\DimTransaksi;
use Carbon\Carbon;

class DW2_3Controller extends Controller
{
    public function index(Request $request)
    {
        // Tetapkan default kuartal ke 1 jika tidak ada input dari request
        $kuartal = $request->get('kuartal', 1); // Default kuartal = 1

        /**
         * Query Data: Jumlah Pembelian Obat Berdasarkan Wilayah dan Kategori
         */
        $query = FactPenjualanObatWilayah::join('dim_waktu_transaksi', 'fact_penjualan_obat_wilayah.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->selectRaw('fact_penjualan_obat_wilayah.id_wilayah, fact_penjualan_obat_wilayah.id_kategori_obat, SUM(fact_penjualan_obat_wilayah.jumlah_obat) as total_jumlah')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->groupBy('fact_penjualan_obat_wilayah.id_wilayah', 'fact_penjualan_obat_wilayah.id_kategori_obat')
            ->get();

        $wilayahs = DimWilayah::all()->pluck('Wilayah', 'id_wilayah')->toArray();
        $categories = DimKategoriObat::all()->pluck('kategori', 'id_kategori_obat')->toArray();
        $months = $this->getMonthsByQuarter($kuartal); // Ambil daftar bulan sesuai kuartal

        // Format data untuk Multiple Bar Chart
        $chartData = [];
        foreach ($wilayahs as $wilayahId => $wilayahName) {
            $chartData[$wilayahName] = [];
            foreach ($categories as $categoryId => $categoryName) {
                $jumlah = $query->where('id_wilayah', $wilayahId)
                                ->where('id_kategori_obat', $categoryId)
                                ->sum('total_jumlah');
                $chartData[$wilayahName][$categoryName] = $jumlah;
            }
        }

        // Line chart jumlah penjualan obat per bulan
        $lineData = FactPenjualanObatWilayah::join('dim_waktu_transaksi', 'fact_penjualan_obat_wilayah.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->selectRaw('dim_waktu_transaksi.bulan, fact_penjualan_obat_wilayah.id_kategori_obat, SUM(fact_penjualan_obat_wilayah.jumlah_obat) as total_jumlah')
            ->whereIn('dim_waktu_transaksi.bulan', $this->getMonthsByQuarter($kuartal))
            ->groupBy('dim_waktu_transaksi.bulan', 'fact_penjualan_obat_wilayah.id_kategori_obat')
            ->get();

        $lineChartData = [];
        $months = $this->getMonthsByQuarter($kuartal); // Ambil daftar bulan sesuai kuartal

        foreach ($categories as $categoryId => $categoryName) {
            $lineChartData[$categoryName] = [];
            foreach ($months as $bulan) { // Hanya iterasi bulan sesuai kuartal
                $jumlah = $lineData->where('id_kategori_obat', $categoryId)->where('bulan', $bulan)->sum('total_jumlah');
                $lineChartData[$categoryName][$bulan] = $jumlah;
            }
        }

        /**
         * Jumlah Pengunjung: Distinct ID Pembelian
         */
        $jumlahPengunjung = DimTransaksi::join('fact_penjualan_pendapatan', 'dim_transaksi.id_transaksi', '=', 'fact_penjualan_pendapatan.id_transaksi')
            ->join('dim_waktu_transaksi', 'fact_penjualan_pendapatan.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->distinct()
            ->count('dim_transaksi.id_pembelian');

        /**
         * Tanggal Transaksi Terbanyak
         */
        $tanggalTransaksiTerbanyak = FactPenjualanPendapatan::join('dim_waktu_transaksi', 'fact_penjualan_pendapatan.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->select('dim_waktu_transaksi.tanggal_transaksi', DB::raw('COUNT(*) as total'))
            ->groupBy('dim_waktu_transaksi.tanggal_transaksi')
            ->orderByDesc('total')
            ->first();

        if ($tanggalTransaksiTerbanyak) {
            $tanggalTransaksiTerbanyak->formatted_date = Carbon::parse($tanggalTransaksiTerbanyak->tanggal_transaksi)
                ->translatedFormat('l, Y-m-d');
        }

        /**
         * Kategori Obat Terbanyak
         */
        $kategoriTerbanyak = FactPenjualanPendapatan::join('dim_kategori_obat', 'fact_penjualan_pendapatan.id_kategori_obat', '=', 'dim_kategori_obat.id_kategori_obat')
            ->join('dim_waktu_transaksi', 'fact_penjualan_pendapatan.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->select('dim_kategori_obat.kategori', DB::raw('SUM(jumlah_obat) as total'))
            ->groupBy('dim_kategori_obat.kategori')
            ->orderByDesc('total')
            ->first();

        /**
         * Obat yang Paling Sering Dibeli
         */
        $obatTerbanyak = FactPenjualanPendapatan::join('dim_transaksi', 'fact_penjualan_pendapatan.id_transaksi', '=', 'dim_transaksi.id_transaksi')
            ->join('dim_waktu_transaksi', 'fact_penjualan_pendapatan.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->select('dim_transaksi.nama_obat', DB::raw('SUM(fact_penjualan_pendapatan.jumlah_obat) as total'))
            ->groupBy('dim_transaksi.nama_obat')
            ->orderByDesc('total')
            ->first();

        /**
         * Return View
         */
        return view('dashboard_dw2dw3', compact(
            'chartData',
            'lineChartData',
            'months',
            'wilayahs',
            'categories',
            'kuartal',
            'jumlahPengunjung',
            'tanggalTransaksiTerbanyak',
            'kategoriTerbanyak',
            'obatTerbanyak'
        ));
    }

    /**
     * Fungsi untuk mendapatkan daftar bulan berdasarkan kuartal
     */
    private function getMonthsByQuarter($kuartal)
    {
        $quarters = [
            1 => [1, 2, 3],   // Kuartal 1: Januari, Februari, Maret
            2 => [4, 5, 6],   // Kuartal 2: April, Mei, Juni
            3 => [7, 8, 9],   // Kuartal 3: Juli, Agustus, September
        ];

        return $quarters[$kuartal] ?? [];
    }
}
