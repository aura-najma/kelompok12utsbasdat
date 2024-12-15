<?php
namespace App\Http\Controllers;

use App\Models\FactNilaiEvaluasi;
use Illuminate\Http\Request;

class DW1Controller extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil filter kuartal dari request (opsional)
        $kuartal = $request->input('kuartal');
    
        // Query data rata-rata per kategori evaluasi (Evaluasi Pelayanan, Apotek, Obat) per bulan
        $barChartData = FactNilaiEvaluasi::selectRaw('
            dim_waktu_evaluasi.bulan,
            dim_tipe_evaluasi.nama_tipe_evaluasi,
            AVG(nilai_evaluasi) as rata_rata
        ')
            ->join('dim_waktu_evaluasi', 'fact_nilai_evaluasi.id_waktu', '=', 'dim_waktu_evaluasi.id_waktu')
            ->join('dim_tipe_evaluasi', 'fact_nilai_evaluasi.id_tipe_evaluasi', '=', 'dim_tipe_evaluasi.id_tipe_evaluasi')
            ->when($kuartal, function ($query) use ($kuartal) {
                return $query->where('dim_waktu_evaluasi.kuartal', $kuartal);
            })
            ->groupBy('dim_waktu_evaluasi.bulan', 'dim_tipe_evaluasi.nama_tipe_evaluasi')
            ->orderBy('dim_waktu_evaluasi.bulan')
            ->get();
    
        $barChart = [];
        foreach ($barChartData as $item) {
            $barChart[$item->bulan][$item->nama_tipe_evaluasi] = $item->rata_rata;
        }
    
        // Line Chart Data
        $lineChartData = FactNilaiEvaluasi::selectRaw('
            dim_waktu_evaluasi.bulan,
            dim_apoteker.nama_apoteker,
            AVG(nilai_evaluasi) as rata_rata
        ')
            ->join('dim_waktu_evaluasi', 'fact_nilai_evaluasi.id_waktu', '=', 'dim_waktu_evaluasi.id_waktu')
            ->join('dim_apoteker', 'fact_nilai_evaluasi.id_apoteker', '=', 'dim_apoteker.id_apoteker')
            ->when($kuartal, function ($query) use ($kuartal) {
                return $query->where('dim_waktu_evaluasi.kuartal', $kuartal);
            })
            ->groupBy('dim_waktu_evaluasi.bulan', 'dim_apoteker.nama_apoteker')
            ->orderBy('dim_waktu_evaluasi.bulan')
            ->get();
    
        $lineChart = [];
        foreach ($lineChartData as $item) {
            $lineChart[$item->nama_apoteker][$item->bulan] = $item->rata_rata;
        }
    
        // Card 1: Apoteker dengan evaluasi_pelayanan 5 terbanyak
        $topApoteker = FactNilaiEvaluasi::with(['apoteker', 'tipeEvaluasi'])
            ->whereHas('tipeEvaluasi', function ($query) {
                $query->where('nama_tipe_evaluasi', 'evaluasi_pelayanan');
            })
            ->where('nilai_evaluasi', 5)
            ->get()
            ->groupBy('id_apoteker')
            ->map(function ($group) {
                return [
                    'apoteker' => optional($group->first()->apoteker)->nama_apoteker,
                    'count' => $group->count(),
                    'total' => FactNilaiEvaluasi::where('id_apoteker', $group->first()->id_apoteker)
                        ->whereHas('tipeEvaluasi', function ($query) {
                            $query->where('nama_tipe_evaluasi', 'evaluasi_pelayanan');
                        })->count(),
                ];
            })
            ->sortByDesc('count')
            ->first();
    
        // Card 2: Total evaluasi di kuartal 3
        $totalEvaluasiKuartal3 = FactNilaiEvaluasi::whereHas('waktuEvaluasi', function ($query) {
            $query->whereIn('bulan', [7, 8, 9]); // Kuartal 3
        })->count();
    
        // Card 3: Persentase perubahan rata-rata evaluasi apotek dari kuartal 2 ke kuartal 3
        $rataRataKuartal2 = FactNilaiEvaluasi::with('waktuEvaluasi')
            ->whereHas('tipeEvaluasi', function ($query) {
                $query->where('nama_tipe_evaluasi', 'evaluasi_apotek');
            })
            ->whereHas('waktuEvaluasi', function ($query) {
                $query->whereIn('bulan', [4, 5, 6]); // Kuartal 2
            })
            ->avg('nilai_evaluasi');
    
        $rataRataKuartal3 = FactNilaiEvaluasi::with('waktuEvaluasi')
            ->whereHas('tipeEvaluasi', function ($query) {
                $query->where('nama_tipe_evaluasi', 'evaluasi_apotek');
            })
            ->whereHas('waktuEvaluasi', function ($query) {
                $query->whereIn('bulan', [7, 8, 9]); // Kuartal 3
            })
            ->avg('nilai_evaluasi');
    
        $persentasePerubahan = null;
        if ($rataRataKuartal2 > 0) {
            $persentasePerubahan = (($rataRataKuartal3 - $rataRataKuartal2) / $rataRataKuartal2) * 100;
        }
    
        return view('dashboard_dw1', [
            'lineChart' => $lineChart,
            'barChart' => $barChart,
            'kuartal' => $kuartal,
            'topApoteker' => $topApoteker,
            'totalEvaluasiKuartal3' => $totalEvaluasiKuartal3,
            'persentasePerubahan' => $persentasePerubahan,
        ]);
    }
    

}
