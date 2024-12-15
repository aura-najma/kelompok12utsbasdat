<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard DW2-3</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Jumlah Pembelian Obat Antar Kategori di Setiap Wilayah</h1>

    @foreach ($chartData as $data)
        <div style="width: 80%; margin: 20px auto;">
            <h3>Wilayah: {{ $data['wilayah'] }}</h3>
            <canvas id="chart-{{ $loop->index }}" width="400" height="200"></canvas>
        </div>

        <script>
            const ctx{{ $loop->index }} = document.getElementById('chart-{{ $loop->index }}').getContext('2d');
            new Chart(ctx{{ $loop->index }}, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($data['categories']) !!},
                    datasets: [{
                        label: 'Jumlah Pembelian',
                        data: {!! json_encode($data['totals']) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: 'Pembelian Obat Kategori di {{ $data['wilayah'] }}' }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endforeach
</body>
</html>
