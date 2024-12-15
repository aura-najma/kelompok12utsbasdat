<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FactPenjualanObatWilayah;
use App\Models\DimKategoriObat;
use App\Models\DimWilayah;

class DW2_3Controller extends Controller
{
    public function index(Request $request)
    {
        // Tetapkan default kuartal ke 1 jika tidak ada input dari request
        $kuartal = $request->get('kuartal', 1); // Default ke 1
    
        // Query data jumlah pembelian obat antar kategori berdasarkan wilayah
        $query = FactPenjualanObatWilayah::join('dim_waktu_transaksi', 'fact_penjualan_obat_wilayah.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->selectRaw('fact_penjualan_obat_wilayah.id_wilayah, fact_penjualan_obat_wilayah.id_kategori_obat, SUM(fact_penjualan_obat_wilayah.jumlah_obat) as total_jumlah')
            ->where('dim_waktu_transaksi.kuartal', $kuartal)
            ->groupBy('fact_penjualan_obat_wilayah.id_wilayah', 'fact_penjualan_obat_wilayah.id_kategori_obat')
            ->get();

        // Ambil nama kategori dan wilayah untuk format data
        $wilayahs = DimWilayah::all()->pluck('Wilayah', 'id_wilayah')->toArray();
        $categories = DimKategoriObat::all()->pluck('kategori', 'id_kategori_obat')->toArray();

        // Format data untuk multiple barchart
        $chartData = [];
        foreach ($wilayahs as $wilayahId => $wilayahName) {
            $chartData[$wilayahName] = [];
            foreach ($categories as $categoryId => $categoryName) {
                $jumlah = $query->where('id_wilayah', $wilayahId)->where('id_kategori_obat', $categoryId)->sum('total_jumlah');
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

        return view('dashboard_dw2dw3', compact('chartData', 'lineChartData', 'wilayahs', 'categories', 'kuartal', 'months'));
    }

    // Fungsi untuk mendapatkan bulan berdasarkan kuartal
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
