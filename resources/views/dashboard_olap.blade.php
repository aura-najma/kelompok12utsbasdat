<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard OLAP</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <h1>Dashboard OLAP</h1>
        <pre>{{ print_r($barChart) }}</pre>

        <!-- Filter Kuartal -->
        <form method="GET" action="/dashboard-olap">
            <label for="kuartal">Filter Kuartal:</label>
            <select name="kuartal" id="kuartal">
                <option value="" {{ $kuartal == '' ? 'selected' : '' }}>Semua Kuartal</option>
                <option value="1" {{ $kuartal == '1' ? 'selected' : '' }}>Kuartal 1</option>
                <option value="2" {{ $kuartal == '2' ? 'selected' : '' }}>Kuartal 2</option>
                <option value="3" {{ $kuartal == '3' ? 'selected' : '' }}>Kuartal 3</option>
                <option value="4" {{ $kuartal == '4' ? 'selected' : '' }}>Kuartal 4</option>
            </select>
            <button type="submit">Terapkan</button>
        </form>

        <!-- Line Chart -->
        <h2>Line Chart - Rata-rata Nilai Evaluasi per Bulan</h2>
        <canvas id="lineChart"></canvas>

        <!-- Bar Chart -->
        <h2>Bar Chart - Rata-rata Nilai Evaluasi per Tipe Evaluasi</h2>
        <canvas id="barChart"></canvas>
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

        const barChartData = @json($barChart);

// Ambil bulan (key utama array) sebagai labels
const barLabels = Object.keys(barChartData).sort(); // [7, 8, 9]

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
