<?php

namespace App\Http\Controllers;

use App\Models\FactNilaiEvaluasi;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DW1Controller extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil filter kuartal dari request
        $kuartal = $request->input('kuartal');
        $apotekerFilter = $request->input('apoteker', '12024'); // Default ke Dyah Ayu

        // Bar Chart Data - Evaluasi Apotek
        $barChartApotek = $this->getBarChartData('evaluasi_apotek', $kuartal);

        // Bar Chart Data - Evaluasi Obat
        $barChartObat = $this->getBarChartData('evaluasi_obat', $kuartal);
        $barChartPelayanan = $this->getBarChartEvaluasiPelayanan($kuartal, $apotekerFilter);

        // Data Word Cloud dan Rating dari tabel evaluasi
        $evaluasiQuery = Evaluasi::query();

        // Word Cloud data
        $wordCloudData = $this->generateWordCloud($evaluasiQuery, $kuartal);

        // Rata-rata rating
        $rataRataRating = $this->getAverageRating($kuartal);

        // Data untuk Cards
        $topApoteker = $this->getTopApoteker($kuartal);
        $totalEvaluasiKuartal = $this->getTotalEvaluasi($kuartal);

        // Cari kata dengan jumlah kemunculan tertinggi
        $mostFrequentWord = collect($wordCloudData)->sortByDesc('count')->first();

        return view('dashboard_dw1', [
            'barChartApotek' => $barChartApotek,
            'barChartObat' => $barChartObat,
            'barChartPelayanan' => $barChartPelayanan,
            'wordCloudData' => $wordCloudData,
            'rataRataRating' => $rataRataRating,
            'topApoteker' => $topApoteker,
            'totalEvaluasiKuartal' => $totalEvaluasiKuartal,
            'mostFrequentWord' => $mostFrequentWord,
            'kuartal' => $kuartal,
            'apotekerFilter' => $apotekerFilter,
        ]);
    }

    /**
     * Mengambil data untuk Bar Chart berdasarkan jenis evaluasi.
     */
    private function getBarChartData($jenisEvaluasi, $kuartal)
    {
        $kategoriEvaluasi = ['Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'];

        $data = FactNilaiEvaluasi::selectRaw('
            dim_waktu_evaluasi.bulan,
            nilai_evaluasi,
            COUNT(*) as jumlah
        ')
            ->join('dim_waktu_evaluasi', 'fact_nilai_evaluasi.id_waktu', '=', 'dim_waktu_evaluasi.id_waktu')
            ->join('dim_tipe_evaluasi', 'fact_nilai_evaluasi.id_tipe_evaluasi', '=', 'dim_tipe_evaluasi.id_tipe_evaluasi')
            ->where('dim_tipe_evaluasi.nama_tipe_evaluasi', $jenisEvaluasi)
            ->when($kuartal, function ($query) use ($kuartal) {
                $query->where('dim_waktu_evaluasi.kuartal', $kuartal);
            })
            ->groupBy('dim_waktu_evaluasi.bulan', 'nilai_evaluasi')
            ->orderBy('dim_waktu_evaluasi.bulan')
            ->orderBy('nilai_evaluasi')
            ->get();

        $formattedData = [];

        foreach ($data as $item) {
            $bulan = $item->bulan;
            $kategori = $this->mapNilaiToKategori($item->nilai_evaluasi);
            $formattedData[$bulan][$kategori] = $item->jumlah;
        }

        // Pastikan semua kategori ada di setiap bulan
        foreach ($formattedData as $bulan => &$bulanData) {
            foreach ($kategoriEvaluasi as $kategori) {
                $bulanData[$kategori] = $bulanData[$kategori] ?? 0;
            }
        }

        return $formattedData;
    }

    /**
     * Generate Word Cloud dari data evaluasi.
     */
    private function generateWordCloud($query, $kuartal = null)
    {
        if ($kuartal) {
            $months = $this->getMonthsByQuarter($kuartal);
            $query->whereRaw('MONTH(created_at) IN (' . implode(',', $months) . ')');
        }

        return $query->select('komentar')
            ->get()
            ->pluck('komentar')
            ->flatMap(function ($komentar) {
                return Str::of($komentar)->lower()->explode(' ');
            })
            ->filter(function ($word) {
                return strlen($word) > 2; // Hanya kata dengan panjang > 2
            })
            ->countBy()
            ->sortDesc()
            ->take(100)
            ->map(function ($count, $word) {
                return ['word' => $word, 'count' => $count];
            })
            ->values()
            ->toArray();
    }

    /**
     * Menghitung rata-rata rating berdasarkan kuartal.
     */
    private function getAverageRating($kuartal = null)
    {
        $query = Evaluasi::query();

        if ($kuartal) {
            $months = $this->getMonthsByQuarter($kuartal);
            $query->whereRaw('MONTH(created_at) IN (' . implode(',', $months) . ')');
        }

        return $query->avg('rating_apotek') ?: 0; // Default ke 0 jika tidak ada data
    }

    /**
     * Mengambil data apoteker dengan evaluasi pelayanan 5 terbanyak.
     */
    private function getTopApoteker($kuartal)
    {
        return FactNilaiEvaluasi::with(['apoteker', 'tipeEvaluasi'])
            ->whereHas('tipeEvaluasi', function ($query) {
                $query->where('nama_tipe_evaluasi', 'evaluasi_pelayanan');
            })
            ->when($kuartal, function ($query) use ($kuartal) {
                $query->whereHas('waktuEvaluasi', function ($subQuery) use ($kuartal) {
                    $subQuery->where('kuartal', $kuartal);
                });
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
    }

    /**
     * Mengambil total evaluasi berdasarkan kuartal.
     */
    private function getTotalEvaluasi($kuartal)
    {
        $query = FactNilaiEvaluasi::query();

        if ($kuartal) {
            $query->whereHas('waktuEvaluasi', function ($subQuery) use ($kuartal) {
                $subQuery->where('kuartal', $kuartal);
            });

            return $query->count()/3;
        }

        return $query->count()/3;
    }

    /**
     * Dapatkan bulan berdasarkan kuartal.
     */
    private function getMonthsByQuarter($kuartal)
    {
        $quarters = [
            1 => [1, 2, 3],
            2 => [4, 5, 6],
            3 => [7, 8, 9],
            4 => [10, 11, 12],
        ];

        return $quarters[$kuartal] ?? [];
    }
    private function getBarChartEvaluasiPelayanan($kuartal, $apotekerFilter)
    {
        $kategoriEvaluasi = ['Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'];

        $data = FactNilaiEvaluasi::selectRaw('
            dim_waktu_evaluasi.bulan,
            nilai_evaluasi,
            COUNT(*) as jumlah
        ')
            ->join('dim_waktu_evaluasi', 'fact_nilai_evaluasi.id_waktu', '=', 'dim_waktu_evaluasi.id_waktu')
            ->join('dim_apoteker', 'fact_nilai_evaluasi.id_apoteker', '=', 'dim_apoteker.id_apoteker')
            ->join('dim_tipe_evaluasi', 'fact_nilai_evaluasi.id_tipe_evaluasi', '=', 'dim_tipe_evaluasi.id_tipe_evaluasi')
            ->where('dim_tipe_evaluasi.nama_tipe_evaluasi', 'evaluasi_pelayanan')
            ->when($kuartal, function ($query) use ($kuartal) {
                $query->where('dim_waktu_evaluasi.kuartal', $kuartal);
            })
            ->when($apotekerFilter, function ($query) use ($apotekerFilter) {
                $query->where('dim_apoteker.id_apoteker', $apotekerFilter); // Ganti filter nama dengan NIP
            })
            
            ->groupBy('dim_waktu_evaluasi.bulan', 'nilai_evaluasi')
            ->orderBy('dim_waktu_evaluasi.bulan')
            ->orderBy('nilai_evaluasi')
            ->get();

        $formattedData = [];

        foreach ($data as $item) {
            $bulan = $item->bulan;
            $kategori = $this->mapNilaiToKategori($item->nilai_evaluasi);
            $formattedData[$bulan][$kategori] = $item->jumlah;
        }

        // Pastikan semua kategori ada di setiap bulan
        foreach ($formattedData as $bulan => &$bulanData) {
            foreach ($kategoriEvaluasi as $kategori) {
                $bulanData[$kategori] = $bulanData[$kategori] ?? 0;
            }
        }

        return $formattedData;
    }
    /**
     * Pemetaan nilai evaluasi ke kategori.
     */
    private function mapNilaiToKategori($nilai)
    {
        $map = [
            1 => 'Sangat Kurang',
            2 => 'Kurang',
            3 => 'Cukup',
            4 => 'Baik',
            5 => 'Sangat Baik',
        ];

        return $map[$nilai] ?? 'Tidak Diketahui';
    }
}
