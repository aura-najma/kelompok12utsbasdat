<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard OLAP</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wordcloud/1.1.0/wordcloud.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Poppins, sans-serif;
        }
        .container {
            max-width: 1500px;
            padding: 20px;
            margin-left: 40px;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            
        }
        .card h3 {
        font-size: 22px; /* Ukuran font */
        margin-bottom: 10px; /* Jarak bawah */
        text-align: center; /* Rata tengah */
        font-weight: bold; /* Ketebalan teks */
        text-align: left;
        color : white;
    }

    .card p {
        font-size: 18px; /* Ukuran font */ /
        text-align: center; /* Rata tengah */
        font-weight: bold; /* Ketebalan teks */
        text-align: left;
        color : white;
    }
        .card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            width: 30%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: linear-gradient(-180deg,rgba(32, 75, 230, 0.84),rgba(54, 190, 248, 0.9));
            margin-top:20px;
        }
        .charts {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .chart-container {
            flex: 1;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .word-cloud-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
       
        
        #wordCloudCanvas {
            width: 100%;
            height: 500px;
            background-color: #f9f9f9;
        }

    
        .navbar {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
        }

        .navbar-brand img {
            width: 300px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right: 30px;
        }

        .navbar-brand .back-btn {
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
    
        h1 {
            text-align: left;
            margin-top: 20px;
            background-image: linear-gradient(-180deg, #204ae6, #36bef8);
            -webkit-background-clip: text;
            color: transparent;  /* Ensure the text is transparent so the background shows */
            font-weight: bold;
        }

        .content-footer {
        text-align: center; /* Rata tengah teks */
    }
    
</style>
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
    <div class="container">
        <h1>Dashboard Evaluasi </h1>

        <form method="GET" action="{{ url('/dashboard_dw1') }}">
        <label for="kuartal">Filter Kuartal:</label>
        <select name="kuartal" id="kuartal" onchange="this.form.submit()">
            <option value="1" {{ $kuartal == '1' ? 'selected' : '' }}>Kuartal 1</option>
            <option value="2" {{ $kuartal == '2' ? 'selected' : '' }}>Kuartal 2</option>
            <option value="3" {{ $kuartal == '3' ? 'selected' : '' }}>Kuartal 3</option>
        </select>
        <input type="hidden" name="apoteker" value="{{ $apotekerFilter }}">
    </form>

        <!-- Cards Section -->
        <div class="cards">
            <div class="card">
                <h3>Best Apoteker</h3>
                @if($topApoteker)
                    <p>{{ $topApoteker['apoteker'] }}</p>
                @else
                    <p>Tidak ada data.</p>
                @endif
            </div>
            <div class="card">
                <h3>Total Evaluasi</h3>
                <p>{{ $totalEvaluasiKuartal }}</p>
            </div>
            <div class="card">
                <h3>Top Word</h3>
                @if($mostFrequentWord)
                    <p>{{ $mostFrequentWord['word'] }}</p>
                @else
                    <p>Tidak ada data.</p>
                @endif
            </div>
            <div class="card">
                <h3>Rata-rata Rating</h3>
                <p>{{ number_format($rataRataRating, 2) }}</p>
            </div>
        </div>

            <!-- Charts Section -->
        <!-- Charts Section -->
        <div class="charts">
            <div class="chart-container">
                <h2>Evaluasi Apotek</h2>
                <canvas id="barChartApotek"></canvas>
            </div>
            <div class="chart-container">
                <h2>Evaluasi Obat</h2>
                <canvas id="barChartObat"></canvas>
            </div>
        </div>


        <!-- Bar Chart Evaluasi Pelayanan -->
        <div class="chart-container" style="width: 100%; margin-top: 20px;">
        <form method="GET" action="{{ url('/dashboard_dw1') }}">
        <label for="apoteker">Pilih Apoteker:</label>
        <select name="apoteker" id="apoteker" onchange="this.form.submit()">
            <option value="12024" {{ $apotekerFilter == '12024' ? 'selected' : '' }}>Dyah Ayu</option>
            <option value="22024" {{ $apotekerFilter == '22024' ? 'selected' : '' }}>Aura Najma</option>
            <option value="32024" {{ $apotekerFilter == '32024' ? 'selected' : '' }}>Wanda Desi</option>
            <option value="42024" {{ $apotekerFilter == '42024' ? 'selected' : '' }}>Zulfikar</option>
        </select>
        <input type="hidden" name="kuartal" value="{{ $kuartal }}">
    </form>
            <h2>Evaluasi Pelayanan</h2>
            <canvas id="barChartPelayanan"></canvas>
        </div>

        <div class="chart-container" style="width: 100%; margin-top: 20px;">
    
    

    <script>
        // Bar Chart Evaluasi Apotek
        const barChartApotek = @json($barChartApotek);
        const barChartLabels = Object.keys(barChartApotek);
        const barChartDatasetsApotek = [
            'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'
        ].map((kategori) => ({
            label: kategori,
            data: barChartLabels.map((bulan) => barChartApotek[bulan][kategori] || 0),
            borderWidth: 1,
        }));

        const ctxApotek = document.getElementById('barChartApotek').getContext('2d');
        new Chart(ctxApotek, {
            type: 'bar',
            data: {
                labels: barChartLabels.map((bulan) => `Bulan ${bulan}`),
                datasets: barChartDatasetsApotek,
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: {
                    x: { title: { display: true, text: 'Bulan' } },
                    y: { title: { display: true, text: 'Jumlah Evaluasi' }, beginAtZero: true },
                },
            },
        });

        // Bar Chart Evaluasi Obat
        const barChartObat = @json($barChartObat);
        const barChartDatasetsObat = [
            'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'
        ].map((kategori) => ({
            label: kategori,
            data: barChartLabels.map((bulan) => barChartObat[bulan][kategori] || 0),
            borderWidth: 1,
        }));

        const ctxObat = document.getElementById('barChartObat').getContext('2d');
        new Chart(ctxObat, {
            type: 'bar',
            data: {
                labels: barChartLabels.map((bulan) => `Bulan ${bulan}`),
                datasets: barChartDatasetsObat,
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: {
                    x: { title: { display: true, text: 'Bulan' } },
                    y: { title: { display: true, text: 'Jumlah Evaluasi' }, beginAtZero: true },
                },
            },
        });

        // Bar Chart Evaluasi Pelayanan
        const barChartPelayanan = @json($barChartPelayanan);
        const barChartDatasetsPelayanan = [
            'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'
        ].map((kategori) => ({
            label: kategori,
            data: barChartLabels.map((bulan) => barChartPelayanan[bulan][kategori] || 0),
            borderWidth: 1,
        }));

        const ctxPelayanan = document.getElementById('barChartPelayanan').getContext('2d');
        new Chart(ctxPelayanan, {
            type: 'bar',
            data: {
                labels: barChartLabels.map((bulan) => `Bulan ${bulan}`),
                datasets: barChartDatasetsPelayanan,
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: {
                    x: { title: { display: true, text: 'Bulan' } },
                    y: { title: { display: true, text: 'Jumlah Evaluasi' }, beginAtZero: true },
                },
            },
        });


        

    </script>

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
</body>
</html>
