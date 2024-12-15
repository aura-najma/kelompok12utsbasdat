<?php

namespace App\Http\Controllers;

use App\Models\FactNilaiEvaluasi;
use Illuminate\Http\Request;

class DW1Controller extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil filter kuartal dari request
        $kuartal = $request->input('kuartal');
    
        // Tentukan bulan berdasarkan kuartal
        $bulanKuartal = [];
        $labels = [];
        if ($kuartal == 1) {
            $bulanKuartal = [1, 2, 3];
            $labels = ['Januari', 'Februari', 'Maret'];
        } elseif ($kuartal == 2) {
            $bulanKuartal = [4, 5, 6];
            $labels = ['April', 'Mei', 'Juni'];
        } elseif ($kuartal == 3) {
            $bulanKuartal = [7, 8, 9];
            $labels = ['Juli', 'Agustus', 'September'];
        } else {
            $bulanKuartal = range(1, 9); // Semua bulan dari Januari hingga September
            $labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September'];
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

        // Grafik 1: Line chart - Rata-rata nilai evaluasi per apoteker
        $lineChartData = FactNilaiEvaluasi::with(['apoteker', 'tipeEvaluasi', 'waktuEvaluasi'])
            ->whereHas('tipeEvaluasi', function ($query) {
                $query->where('nama_tipe_evaluasi', 'evaluasi_pelayanan'); // Hanya evaluasi_pelayanan
            })
            ->when(!empty($bulanKuartal), function ($query) use ($bulanKuartal) {
                $query->whereHas('waktuEvaluasi', function ($query) use ($bulanKuartal) {
                    $query->whereIn('bulan', $bulanKuartal);
                });
            })
            ->get()
            ->groupBy('id_apoteker') // Kelompokkan data berdasarkan apoteker
            ->map(function ($evaluasiPerApoteker) use ($bulanKuartal) {
                // Ambil nama apoteker
                $apoteker = optional($evaluasiPerApoteker->first()->apoteker)->nama_apoteker;
    
                // Hitung rata-rata nilai per bulan
                $nilaiPerBulan = $evaluasiPerApoteker->groupBy(function ($item) {
                    return optional($item->waktuEvaluasi)->bulan;
                })->map(function ($dataPerBulan) {
                    return $dataPerBulan->avg('nilai_evaluasi');
                });
    
                // Pastikan semua bulan dalam kuartal ada, tambahkan null jika tidak ada
                return [
                    'apoteker' => $apoteker,
                    'data' => collect($bulanKuartal)->mapWithKeys(function ($bulan) use ($nilaiPerBulan) {
                        return [$bulan => $nilaiPerBulan->get($bulan, null)];
                    }),
                ];
            });

    
        // Grafik 2: Bar chart - Rata-rata nilai evaluasi per tipe evaluasi
        $barChartData = FactNilaiEvaluasi::with(['tipeEvaluasi', 'waktuEvaluasi'])
            ->whereHas('waktuEvaluasi', function ($query) use ($bulanKuartal) {
                $query->whereIn('bulan', $bulanKuartal);
            })
            ->get()
            ->groupBy('tipeEvaluasi.nama_tipe_evaluasi') // Kelompokkan berdasarkan nama_tipe_evaluasi
            ->map(function ($evaluasiPerTipe) use ($bulanKuartal) {
                // Hitung rata-rata nilai evaluasi untuk setiap bulan
                return collect($bulanKuartal)->mapWithKeys(function ($bulan) use ($evaluasiPerTipe) {
                    $nilaiPerBulan = $evaluasiPerTipe->where('waktuEvaluasi.bulan', $bulan);
                    return [$bulan => $nilaiPerBulan->avg('nilai_evaluasi')];
                });
            });
    

    

        // Kirim data ke view
        return view('dashboard_dw1', compact('topApoteker', 'totalEvaluasiKuartal3', 'persentasePerubahan', 'lineChartData', 'barChartData', 'labels', 'kuartal'));
    }
}
