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
        /* Global Style */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 5px;
        }

        h1 {
            font-size: 2.5rem;
            background-image: linear-gradient(-180deg, #204ae6, #36bef8);
            -webkit-background-clip: text;
            color: transparent; 
            text-align: center;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 1.5rem;
            color: #6c757d;
            text-align: center;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
            padding: 10px 20px;
        }

        .navbar-brand img {
            width: 150px;
        }

        .navbar-nav .nav-link {
            font-size: 16px;
            color: white !important;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #d8f3ff !important;
        }

        /* Cards */
        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body h5 {
            font-size: 1.25rem;
            font-weight: bold;
            background-image: linear-gradient(-180deg, #204ae6, #36bef8);
            -webkit-background-clip: text;
            color: transparent; 
            margin-bottom: 5px;
        }

        /* Charts */
        .card-title {
            font-size: 1.5rem;
            background-image: linear-gradient(-180deg, #204ae6, #36bef8);
            -webkit-background-clip: text;
            color: transparent;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .custom-pie-chart {
            width: 600px;
            height: 500px;
            max-width: 100%;
            margin: 0 auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            h4 {
                font-size: 1.25rem;
            }

            .custom-pie-chart {
                width: 200px;
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo2.png" alt="Logo">
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="container my-4">
        <h1 class="text-center mb-4 fw-bold">Dashboard Penjualan</h1>
    </div>

    <!-- Filter Form -->
    <div class="container mb-4">
        <form method="GET" action="{{ url('dashboard_dw2dw3') }}" class="row align-items-center justify-content-center">
            <div class="col-md-4 mb-3">
                <select name="kuartal" id="kuartal" class="form-select">
                    <option value="1" {{ $kuartal == 1 ? 'selected' : '' }}>Kuartal 1</option>
                    <option value="2" {{ $kuartal == 2 ? 'selected' : '' }}>Kuartal 2</option>
                    <option value="3" {{ $kuartal == 3 ? 'selected' : '' }}>Kuartal 3</option>
                </select>
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-center">
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
                        <h5>Top Tanggal Transaksi</h5>
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

        <!-- Pie Chart Pendapatan Berdasarkan Jenis Obat -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg p-4">
                    <h4 class="card-title text-center mb-4">Persentase Pendapatan Berdasarkan Jenis Obat</h4>
                    <div class="card-body d-flex justify-content-center">
                        <canvas id="pieChartPendapatan" class="custom-pie-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Footer -->
     <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Lifespring Drugstore ❤️ Apotek Aman dan Terpercaya
                </div>
              </div>
            </footer>
            <!-- / Footer -->

    <!-- Chart.js Scripts -->
    <script>
    const pastelColors = [
        'rgba(247, 119, 131, 0.9)', // Lebih terang Pink pastel
        'rgba(225, 159, 73, 0.9)', // Lebih terang Orange pastel
        'rgba(69, 144, 243, 0.9)', // Lebih terang Yellow pastel
        'rgba(100, 218, 133, 0.9)', // Lebih terang Green pastel
        'rgba(252, 227, 87, 0.9)', // Lebih terang Blue pastel
        'rgba(210, 160, 235, 0.9)', // Lebih terang Purple pastel
        'rgba(139, 253, 253, 0.9)'  // Lebih terang Light Gray pastel
    ];

        // Bar Chart Data
        const barChartData = @json($chartData);
        const wilayahs = @json(array_keys($chartData));
        const categories = @json(array_keys($chartData[array_key_first($chartData)]));
        const barDatasets = categories.map((category, index) => ({
            label: category,
            data: wilayahs.map(wilayah => barChartData[wilayah][category] || 0),
            backgroundColor: pastelColors[index % pastelColors.length], // Warna pastel
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
            borderColor: pastelColors[index % pastelColors.length],    // Garis warna pastel
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
                labels: monthLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: pendapatanValues,
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
                },
                scales: {
                    x: { title: { display: true, text: 'Bulan' } },
                    y: { beginAtZero: true, title: { display: true, text: 'Pendapatan' } }
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


        // Pie Chart Pendapatan
        const piePendapatanData = @json($pieChartWithPercentage);
        const pieLabels = Object.keys(piePendapatanData);
        const pieValues = Object.values(piePendapatanData);
        new Chart(document.getElementById('pieChartPendapatan').getContext('2d'), {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieValues,
                    backgroundColor: pastelColors.slice(0, pieLabels.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        });
    </script>
</body>
</html>
