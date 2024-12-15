<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard DW1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .card-icon.success {
            color: #28a745;
        }
        .card-icon.warning {
            color: #ffc107;
        }
        .card-icon.danger {
            color: #dc3545;
        }
        .card-icon.info {
            color: #17a2b8;
        }

        .chart-container {
            margin-top: 20px;
        }

        canvas {
            max-width: 100%;
            height: 400px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container my-4">
        <h1 class="text-center mb-4">Dashboard DW1</h1>

        <!-- Filter Kuartal -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="{{ route('dashboard.dw1') }}" class="d-flex align-items-center">
                    <label for="kuartal" class="me-2 fw-bold">Pilih Kuartal:</label>
                    <select name="kuartal" id="kuartal" class="form-select w-50" onchange="this.form.submit()">
                        <option value="" {{ request('kuartal') == '' ? 'selected' : '' }}>Semua Kuartal</option>
                        <option value="1" {{ request('kuartal') == '1' ? 'selected' : '' }}>Kuartal 1 (Jan - Mar)</option>
                        <option value="2" {{ request('kuartal') == '2' ? 'selected' : '' }}>Kuartal 2 (Apr - Jun)</option>
                        <option value="3" {{ request('kuartal') == '3' ? 'selected' : '' }}>Kuartal 3 (Jul - Sep)</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon success">🏆</div>
                        <h5 class="card-title">Top Apoteker</h5>
                        <p class="card-text">{{ $topApoteker['apoteker'] ?? 'Tidak ada' }}</p>
                        <p class="card-text"><strong>{{ $topApoteker['count'] ?? 0 }} Sangat Baik dari {{ $topApoteker['total'] ?? 0 }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon warning">📊</div>
                        <h5 class="card-title">Total Evaluasi Kuartal 3</h5>
                        <p class="card-text"><strong>{{ $totalEvaluasiKuartal3 }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon danger">📉</div>
                        <h5 class="card-title">Perubahan Evaluasi Apotek</h5>
                        <p class="card-text">
                            @if (!is_null($persentasePerubahan))
                                <strong>{{ round($persentasePerubahan, 2) }}%</strong>
                            @else
                                <em>Data tidak tersedia</em>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon info">📝</div>
                        <h5 class="card-title">Kosong</h5>
                        <p class="card-text">--</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="row chart-container">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Line Chart: Rata-rata Nilai Evaluasi per Apoteker</h5>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Bar Chart: Rata-rata Nilai Evaluasi per Tipe Evaluasi</h5>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script>
    // Data dari Controller
    const lineChartData = @json($lineChartData);
    const barChartData = @json($barChartData);
    const labels = @json($labels);

    console.log("Line Chart Data (Original):", lineChartData);
    console.log("Bar Chart Data (Original):", barChartData);
    console.log("Labels (Original):", labels);

    // Tetapkan warna tetap untuk dataset
    const lineColors = ['#28a745', '#007bff', '#ffc107', '#dc3545', '#6f42c1'];
    const barColors = ['#007bff', '#ffc107', '#dc3545', '#6f42c1', '#28a745'];

    // Filter Data Berdasarkan Kuartal
    const kuartal = "{{ request('kuartal') }}";
    let filteredLabels = labels;
    let filteredLineData = Object.values(lineChartData); // Konversi ke array
    let filteredBarData = barChartData;

    if (kuartal === "1") {
        filteredLabels = labels.slice(0, 3); // Januari-Maret
        filteredLineData = filteredLineData.map(dataset => ({
            ...dataset,
            data: [1, 2, 3].map(bulan => dataset.data[bulan] || 0), // Ambil data bulan 1-3
        }));
        filteredBarData = Object.keys(barChartData).reduce((result, tipe) => {
            result[tipe] = [1, 2, 3].map(bulan => barChartData[tipe][bulan] || 0); // Data bulan 1-3
            return result;
        }, {});
    } else if (kuartal === "2") {
        filteredLabels = labels.slice(3, 6); // April-Juni
        filteredLineData = filteredLineData.map(dataset => ({
            ...dataset,
            data: [4, 5, 6].map(bulan => dataset.data[bulan] || 0), // Ambil data bulan 4-6
        }));
        filteredBarData = Object.keys(barChartData).reduce((result, tipe) => {
            result[tipe] = [4, 5, 6].map(bulan => barChartData[tipe][bulan] || 0); // Data bulan 4-6
            return result;
        }, {});
    } else if (kuartal === "3") {
        filteredLabels = labels.slice(6, 9); // Juli-September
        filteredLineData = filteredLineData.map(dataset => ({
            ...dataset,
            data: [7, 8, 9].map(bulan => dataset.data[bulan] || 0), // Ambil data bulan 7-9
        }));
        filteredBarData = Object.keys(barChartData).reduce((result, tipe) => {
            result[tipe] = [7, 8, 9].map(bulan => barChartData[tipe][bulan] || 0); // Data bulan 7-9
            return result;
        }, {});
    }

    console.log("Filtered Labels:", filteredLabels);
    console.log("Filtered Line Data:", filteredLineData);
    console.log("Filtered Bar Data:", filteredBarData);

    // Line Chart
    const lineDatasets = filteredLineData.map((dataset, index) => ({
        label: dataset.apoteker,
        data: dataset.data, // Data yang sudah difilter
        borderColor: lineColors[index % lineColors.length],
        backgroundColor: lineColors[index % lineColors.length],
        tension: 0.1,
        fill: false,
        borderWidth: 2,
    }));

    console.log("Line Datasets:", lineDatasets);

    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: { labels: filteredLabels, datasets: lineDatasets },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                x: { title: { display: true, text: 'Bulan' } },
                y: { beginAtZero: true, title: { display: true, text: 'Rata-rata Nilai' } },
            },
        },
    });

    // Bar Chart
    const barDatasets = Object.keys(filteredBarData).map((tipeEvaluasi, index) => ({
        label: tipeEvaluasi,
        data: filteredBarData[tipeEvaluasi], // Data yang sudah difilter
        backgroundColor: barColors[index % barColors.length],
        borderColor: barColors[index % barColors.length],
        borderWidth: 1,
    }));

    console.log("Bar Datasets:", barDatasets);

    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: { labels: filteredLabels, datasets: barDatasets },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                x: { title: { display: true, text: 'Bulan' } },
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah Evaluasi' } },
            },
        },
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
