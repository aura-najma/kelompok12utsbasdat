<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard DW2-3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <style>

</style>
</head>
<body>
    <!-- Header -->
    <div class="container my-4">
        <h1 class="text-center mb-4 fw-bold">Dashboard Jumlah Pembelian Obat</h1>
        <h4 class="text-center text-secondary">Berdasarkan Wilayah, Kategori, dan Bulan</h4>
    </div>

    <!-- Filter Form -->
    <div class="container mb-4">
        <form method="GET" action="{{ url('dashboard_dw2dw3') }}" class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label for="kuartal" class="form-label fw-bold">Filter Kuartal:</label>
                <select name="kuartal" id="kuartal" class="form-select">
                    <option value="1" {{ $kuartal == 1 ? 'selected' : '' }}>Kuartal 1</option>
                    <option value="2" {{ $kuartal == 2 ? 'selected' : '' }}>Kuartal 2</option>
                    <option value="3" {{ $kuartal == 3 ? 'selected' : '' }}>Kuartal 3</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <!-- Cards -->
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Jumlah Pengunjung</h5>
                        <p>{{ $jumlahPengunjung }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Tanggal Transaksi Terbanyak</h5>
                        <p>{{ $tanggalTransaksiTerbanyak ? $tanggalTransaksiTerbanyak->formatted_date : '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Kategori Obat Terbanyak</h5>
                        <p>{{ $kategoriTerbanyak ? $kategoriTerbanyak->kategori : '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Obat Terbanyak</h5>
                        <p>{{ $obatTerbanyak ? $obatTerbanyak->nama_obat : '-' }}</p>
                        <p>Total Dibeli: <strong>{{ $obatTerbanyak ? $obatTerbanyak->total : 0 }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="container mb-5">
        <div class="row mb-4">
            <!-- Bar Chart -->
            <div class="col-12">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Jumlah Pembelian Obat Berdasarkan Wilayah</h4>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Line Chart Penjualan Obat -->
            <div class="col-12">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Jumlah Penjualan Obat Per Bulan</h4>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Line Chart Pendapatan -->
            <div class="col-12">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Pendapatan Per Bulan</h4>
                    <div class="card-body">
                        <canvas id="lineChartPendapatan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart Pendapatan Berdasarkan Jenis Obat -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg p-4">
                <h4 class="card-title text-center mb-4">Persentase Pendapatan Berdasarkan Jenis Obat</h4>
                <div class="card-body">
                    <canvas id="pieChartPendapatan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container text-center mb-4">
        <p class="text-muted">&copy; {{ date('Y') }} Dashboard DW2-3 | Data Visualisasi Obat</p>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        // Bar Chart
        const barChartData = @json($chartData);
        const wilayahs = @json(array_keys($chartData));
        const categories = @json(array_keys($chartData[array_key_first($chartData)]));
        const barDatasets = categories.map((category, index) => ({
            label: category,
            data: wilayahs.map(wilayah => barChartData[wilayah][category] || 0),
            backgroundColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 0.7)`,
            borderWidth: 1
        }));

        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: { labels: wilayahs, datasets: barDatasets },
            options: { responsive: true, plugins: { legend: { position: 'right' } } }
        });

        // Line Chart Penjualan
        const lineChartData = @json($lineChartData);
        const months = @json($months);
        const monthLabels = months.map(bulan => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September'][bulan - 1]);

        const lineDatasets = Object.keys(lineChartData).map((category, index) => ({
            label: category,
            data: months.map(bulan => lineChartData[category][bulan] || 0),
            borderColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 1)`,
            borderWidth: 2,
            fill: false
        }));

        new Chart(document.getElementById('lineChart').getContext('2d'), {
            type: 'line',
            data: { labels: monthLabels, datasets: lineDatasets },
            options: { responsive: true, plugins: { legend: { position: 'top' } } }
        });

        // Line Chart Pendapatan
        const pendapatanData = @json($linePendapatanData);
        const pendapatanValues = Object.values(pendapatanData);
        new Chart(document.getElementById('lineChartPendapatan').getContext('2d'), {
    type: 'line',
    data: {
        labels: monthLabels, // Label bulan akan tetap tampil
        datasets: [{
            label: 'Pendapatan',
            data: pendapatanValues, // Gunakan nilai pendapatan
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { 
                display: true, 
                text: 'Pendapatan Per Bulan' 
            }
        },
        scales: {
            x: {
                title: {
                    display: true, // Menampilkan keterangan sumbu X
                    text: 'Bulan' // Keterangan sumbu X
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Pendapatan' // Judul sumbu Y
                }
            }
        }
    }
});
@php
    $totalPendapatan = array_sum($piePendapatanChartData);
    $pieChartWithPercentage = [];

    foreach ($piePendapatanChartData as $jenisObat => $pendapatan) {
        $persentase = number_format(($pendapatan / $totalPendapatan) * 100, 2); // Format 2 desimal
        $pieChartWithPercentage["$jenisObat ({$persentase}%)"] = $pendapatan;
    }
@endphp


     // Ambil data dari Blade
     const piePendapatanData = @json($pieChartWithPercentage);

// Ekstrak label (jenis obat + persentase) dan nilai pendapatan
const pieLabels = Object.keys(piePendapatanData);
const pieValues = Object.values(piePendapatanData);

// Warna-warna untuk tiap segmen pie chart
const pieColors = ['#4CAF50', '#FF9800', '#F44336', '#2196F3', '#9C27B0', '#E91E63'];

// Inisialisasi Pie Chart
new Chart(document.getElementById('pieChartPendapatan').getContext('2d'), {
    type: 'pie',
    data: {
        labels: pieLabels, // Sudah termasuk jenis obat + persentase
        datasets: [{
            data: pieValues,
            backgroundColor: pieColors.slice(0, pieLabels.length),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top' // Letak legend
            },
            title: {
                display: true,
                text: 'Persentase Pendapatan Berdasarkan Jenis Obat'
            }
        }
    }
});
    </script>
</body>
</html>
