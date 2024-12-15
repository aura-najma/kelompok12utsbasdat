<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard OLAP</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            width: 30%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .charts {
            display: flex;
            gap: 20px;
        }
        .chart-container {
            flex: 1;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        canvas {
            display: block;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard OLAP</h1>

        <!-- Cards -->
        <div class="cards">
            <!-- Card 1 -->
            <div class="card">
                <h3>Top Apoteker dengan Evaluasi Pelayanan 5</h3>
                @if($topApoteker)
                    <p>Nama: {{ $topApoteker['apoteker'] }}</p>
                    <p>Evaluasi 5: {{ $topApoteker['count'] }} dari {{ $topApoteker['total'] }} evaluasi</p>
                @else
                    <p>Tidak ada data.</p>
                @endif
            </div>

            <!-- Card 2 -->
            <div class="card">
                <h3>Total Evaluasi di Kuartal 3</h3>
                <p>{{ $totalEvaluasiKuartal3 }}</p>
            </div>

            <!-- Card 3 -->
            <div class="card">
                <h3>Persentase Perubahan Evaluasi Apotek</h3>
                @if($persentasePerubahan !== null)
                    <p>{{ number_format($persentasePerubahan, 2) }}%</p>
                @else
                    <p>Data tidak tersedia.</p>
                @endif
            </div>
        </div>

        <!-- Filter Kuartal -->
        <form method="GET" action="/dashboard_dw1">
            <label for="kuartal">Filter Kuartal:</label>
            <select name="kuartal" id="kuartal">
                <option value="" {{ $kuartal == '' ? 'selected' : '' }}>Semua Kuartal</option>
                <option value="1" {{ $kuartal == '1' ? 'selected' : '' }}>Kuartal 1</option>
                <option value="2" {{ $kuartal == '2' ? 'selected' : '' }}>Kuartal 2</option>
                <option value="3" {{ $kuartal == '3' ? 'selected' : '' }}>Kuartal 3</option>
            </select>
            <button type="submit">Terapkan</button>
        </form>

        <!-- Charts Section -->
        <div class="charts">
            <!-- Line Chart -->
            <div class="chart-container">
                <h2>Line Chart - Rata-rata Nilai Evaluasi per Bulan</h2>
                <canvas id="lineChart"></canvas>
            </div>

            <!-- Bar Chart -->
            <div class="chart-container">
                <h2>Bar Chart - Rata-rata Nilai Evaluasi per Tipe Evaluasi</h2>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Data dari server untuk Line Chart
        const lineChartData = @json($lineChart);
        const lineLabels = [...new Set(Object.values(lineChartData).flatMap(obj => Object.keys(obj)))].sort();
        const lineDatasets = Object.keys(lineChartData).map(apoteker => ({
            label: apoteker,
            data: lineLabels.map(bulan => lineChartData[apoteker][bulan] || 0),
            fill: false,
            borderWidth: 2,
            tension: 0.1,
        }));

        // Render Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: lineLabels.map(label => `Bulan ${label}`),
                datasets: lineDatasets,
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Rata-rata Evaluasi',
                        },
                    },
                },
            },
        });

        // Data dari server untuk Bar Chart
        const barChartData = @json($barChart);

        // Ambil bulan (key utama array) sebagai labels
        const barLabels = Object.keys(barChartData).sort();

        // Definisikan kategori evaluasi
        const categories = ['evaluasi_apotek', 'evaluasi_obat', 'evaluasi_pelayanan'];

        // Buat dataset untuk setiap kategori evaluasi
        const barDatasets = categories.map(category => ({
            label: category.replace('evaluasi_', 'Evaluasi ').toUpperCase(),
            data: barLabels.map(bulan => barChartData[bulan]?.[category] || 0), // Isi 0 jika data tidak ada
            borderWidth: 1,
        }));

        // Render Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barLabels.map(label => `Bulan ${label}`), // Format label bulan
                datasets: barDatasets,
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Rata-rata Nilai Evaluasi',
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</body>
</html>
