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
        $kuartal = $request->get('kuartal', null); // Ambil filter kuartal dari request
        
        // Query data jumlah pembelian obat antar kategori berdasarkan wilayah
        $query = FactPenjualanObatWilayah::join('dim_waktu_transaksi', 'fact_penjualan_obat_wilayah.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->selectRaw('fact_penjualan_obat_wilayah.id_wilayah, fact_penjualan_obat_wilayah.id_kategori_obat, SUM(fact_penjualan_obat_wilayah.jumlah_obat) as total_jumlah');
    
        if ($kuartal) {
            $query->where('dim_waktu_transaksi.kuartal', $kuartal);
        }
    
        $data = $query->groupBy('fact_penjualan_obat_wilayah.id_wilayah', 'fact_penjualan_obat_wilayah.id_kategori_obat')->get();
    
        // Ambil nama kategori dan wilayah untuk format data
        $wilayahs = DimWilayah::all()->pluck('Wilayah', 'id_wilayah')->toArray();
        $categories = DimKategoriObat::all()->pluck('kategori', 'id_kategori_obat')->toArray();
    
        // Format data untuk multiple barchart
        $chartData = [];
        foreach ($wilayahs as $wilayahId => $wilayahName) {
            $chartData[$wilayahName] = [];
            foreach ($categories as $categoryId => $categoryName) {
                $jumlah = $data->where('id_wilayah', $wilayahId)->where('id_kategori_obat', $categoryId)->sum('total_jumlah');
                $chartData[$wilayahName][$categoryName] = $jumlah;
            }
        }
    
        // Line chart jumlah penjualan obat per bulan
        $lineData = FactPenjualanObatWilayah::join('dim_waktu_transaksi', 'fact_penjualan_obat_wilayah.id_waktu', '=', 'dim_waktu_transaksi.id_waktu')
            ->selectRaw('dim_waktu_transaksi.bulan, fact_penjualan_obat_wilayah.id_kategori_obat, SUM(fact_penjualan_obat_wilayah.jumlah_obat) as total_jumlah')
            ->when($kuartal, function ($query) use ($kuartal) {
                return $query->where('dim_waktu_transaksi.kuartal', $kuartal);
            })
            ->groupBy('dim_waktu_transaksi.bulan', 'fact_penjualan_obat_wilayah.id_kategori_obat')
            ->get();
    
        $lineChartData = [];
        foreach ($categories as $categoryId => $categoryName) {
            $lineChartData[$categoryName] = [];
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $jumlah = $lineData->where('id_kategori_obat', $categoryId)->where('bulan', $bulan)->sum('total_jumlah');
                $lineChartData[$categoryName][$bulan] = $jumlah;
            }
        }
    
        return view('dashboard_dw2dw3', compact('chartData', 'lineChartData', 'wilayahs', 'categories', 'kuartal'));
    }  
    
}
