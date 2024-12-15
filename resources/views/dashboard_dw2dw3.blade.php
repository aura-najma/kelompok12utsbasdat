<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard DW2-3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <!-- Charts Section -->
    <div class="container mb-5">
        <div class="row">
            <!-- Bar Chart -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Jumlah Pembelian Obat Berdasarkan Wilayah dan Kategori</h4>
                    <div class="card-body">
                        <canvas id="barChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Jumlah Penjualan Obat Per Bulan</h4>
                    <div class="card-body">
                        <canvas id="lineChart" width="400" height="300"></canvas>
                    </div>
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
        // Data untuk Bar Chart
        const barChartData = @json($chartData);
        const wilayahs = @json(array_keys($chartData));
        const categories = @json(array_keys($chartData[array_key_first($chartData)]));

        const barDatasets = categories.map((category, index) => {
            return {
                label: category,
                data: wilayahs.map(wilayah => barChartData[wilayah][category] || 0),
                backgroundColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 0.7)`,
                borderColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 1)`,
                borderWidth: 1
            };
        });

        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: wilayahs,
                datasets: barDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Jumlah Pembelian Obat Berdasarkan Wilayah dan Kategori' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Data untuk Line Chart
        const lineChartData = @json($lineChartData); // Data dari controller
        const months = @json($months); // Bulan sesuai kuartal

        const bulanLabels = {
            1: 'Januari', 2: 'Februari', 3: 'Maret',
            4: 'April', 5: 'Mei', 6: 'Juni',
            7: 'Juli', 8: 'Agustus', 9: 'September',
            10: 'Oktober', 11: 'November', 12: 'Desember'
        };

        const filteredLabels = months.map((bulan) => bulanLabels[bulan]); // Label sesuai kuartal

        const lineDatasets = Object.keys(lineChartData).map((category, index) => {
            return {
                label: category,
                data: months.map((bulan) => lineChartData[category][bulan] || 0),
                borderColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 1)`,
                backgroundColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 0.2)`,
                borderWidth: 2,
                fill: false
            };
        });

        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: filteredLabels, // Sumbu-X hanya untuk bulan kuartal
                datasets: lineDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Jumlah Penjualan Obat Per Bulan' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
