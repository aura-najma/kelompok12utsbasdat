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
        .word-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .word-cloud span {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard OLAP</h1>

        <!-- Filter Section -->
        <form method="GET" action="/dashboard_dw1" style="margin-bottom: 20px;">
            <label for="kuartal">Filter Kuartal:</label>
            <select name="kuartal" id="kuartal">
                <option value="1" {{ $kuartal == '1' ? 'selected' : '' }}>Kuartal 1</option>
                <option value="2" {{ $kuartal == '2' ? 'selected' : '' }}>Kuartal 2</option>
                <option value="3" {{ $kuartal == '3' ? 'selected' : '' }}>Kuartal 3</option>
                <option value="4" {{ $kuartal == '4' ? 'selected' : '' }}>Kuartal 4</option>
            </select>
    
            <button type="submit">Terapkan</button>
        </form>

        <!-- Cards Section -->
        <div class="cards">
            <div class="card">
                <h3>Top Apoteker Yang Paling Sering Mendapat Sangat Baik</h3>
                @if($topApoteker)
                    <p>Nama: {{ $topApoteker['apoteker'] }}</p>
                @else
                    <p>Tidak ada data.</p>
                @endif
            </div>
            <div class="card">
                <h3>Total Evaluasi</h3>
                <p>{{ $totalEvaluasiKuartal }}</p>
            </div>
            <div class="card">
                <h3>Kata Terbanyak dari Word Cloud</h3>
                @if($mostFrequentWord)
                    <p>Kata: "{{ $mostFrequentWord['word'] }}"</p>
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
                <h2>Bar Chart - Evaluasi Apotek</h2>
                <canvas id="barChartApotek"></canvas>
            </div>
            <div class="chart-container">
                <h2>Bar Chart - Evaluasi Obat</h2>
                <canvas id="barChartObat"></canvas>
            </div>
        </div>

        <!-- Bar Chart Evaluasi Pelayanan -->
        <div class="chart-container" style="width: 100%; margin-top: 20px;">
            <form>
        <label for="apoteker">Filter Apoteker:</label>
            <select name="apoteker" id="apoteker">
                <option value="12024" {{ $apotekerFilter == '12024' ? 'selected' : '' }}>Dyah Ayu</option>
                <option value="22024" {{ $apotekerFilter == '22024' ? 'selected' : '' }}>Aura Najma</option>
                <option value="32024" {{ $apotekerFilter == '32024' ? 'selected' : '' }}>Wanda Desi</option>
                <option value="42024" {{ $apotekerFilter == '42024' ? 'selected' : '' }}>Zulfikar</option>
            </select>
            <button type="submit">Terapkan</button>
    </form>
            <h2>Bar Chart - Evaluasi Pelayanan</h2>
            <canvas id="barChartPelayanan"></canvas>
        </div>


        <!-- Word Cloud Section -->
        <div class="word-cloud-container">
            <h2>Word Cloud</h2>
            <div class="word-cloud">
                @if(count($wordCloudData) > 0)
                    @foreach($wordCloudData as $word)
                        <span>{{ $word['word'] }}</span>
                    @endforeach
                @else
                    <p>Tidak ada data Word Cloud untuk kuartal ini.</p>
                @endif
            </div>
        </div>
    </div>

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
</body>
</html>
