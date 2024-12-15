<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard DW2-3</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Jumlah Pembelian Obat Berdasarkan Wilayah dan Kategori</h1>

    <form method="GET" action="{{ url('dashboard_dw2dw3') }}" style="margin-bottom: 20px;">
        <label for="kuartal">Filter Kuartal:</label>
        <select name="kuartal" id="kuartal">
            <option value="">Semua Kuartal</option>
            <option value="1" {{ $kuartal == 1 ? 'selected' : '' }}>Kuartal 1</option>
            <option value="2" {{ $kuartal == 2 ? 'selected' : '' }}>Kuartal 2</option>
            <option value="3" {{ $kuartal == 3 ? 'selected' : '' }}>Kuartal 3</option>
            <option value="4" {{ $kuartal == 4 ? 'selected' : '' }}>Kuartal 4</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div style="width: 80%; margin: auto;">
        <canvas id="multiBarChart" width="800" height="400"></canvas>
    </div>

    <script>
    const chartData = @json($chartData);
    const wilayahs = @json(array_keys($chartData));
    const categories = @json(array_keys($chartData[array_key_first($chartData)]));

        // Format data untuk Chart.js
        const datasets = categories.map((category, index) => {
            return {
                label: category,
                data: wilayahs.map(wilayah => chartData[wilayah][category] || 0),
                backgroundColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 0.5)`,
                borderColor: `rgba(${75 + index * 20}, ${192 - index * 20}, ${192 - index * 10}, 1)`,
                borderWidth: 1
            };
        });

        const ctx = document.getElementById('multiBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: wilayahs, // Wilayah sebagai sumbu-x
                datasets: datasets // Data kategori sebagai batang
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Jumlah Pembelian Obat Berdasarkan Wilayah dan Kategori' }
                },
                scales: {
                    x: { stacked: false },
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
