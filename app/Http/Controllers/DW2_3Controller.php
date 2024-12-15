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
    
        return view('dashboard_dw2dw3', compact('chartData', 'wilayahs', 'categories', 'kuartal'));
    }
    

    
    
    
}
