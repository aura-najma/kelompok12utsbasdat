<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/images/bginputpasien.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
            border: 1px solid lightgrey;
            max-width: 800px;
        }

        h1, h3 {
            color: #204ae6;
            text-align: center;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-radius: 10px;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #204ae6; /* Warna latar belakang lebih gelap */
            color: #ffffff; /* Teks tetap putih karena background sudah lebih gelap */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            text-align: center;
        }

        td {
            background-color: rgba(54, 190, 248, 0.1);
            font-size: 0.9rem;
        }

        .table-total {
            font-weight: 700;
            color: #204ae6;
            margin-top: 1.5rem;
            text-align: right;
        }

        .text-center {
            margin-top: 2rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice Pembelian Obat</h1>
        <div class="mb-4">
            <p><strong>ID Pembelian:</strong> {{ $idPembelian }}</p>
            <p><strong>Tanggal Pembuatan:</strong> {{ $created_at->format('d-m-Y H:i:s') }}</p> <!-- Mengambil created_at dari transaksi -->
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan (Rp)</th>
                    <th>Harga Total (Rp)</th>
                    <th>Dosis</th>
                    <th>Aturan Pakai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiData as $transaksi)
                <tr>
                    <td>{{ $transaksi['nama_obat'] }}</td>
                    <td style="text-align: center;">{{ $transaksi['jumlah_obat'] }}</td>
                    <td>{{ number_format($transaksi['harga_satuan'], 2, ',', '.') }}</td>
                    <td>{{ number_format($transaksi['harga_total'], 2, ',', '.') }}</td>
                    <td>{{ $transaksi['dosis'] }}</td>
                    <td>{{ $transaksi['aturan_pakai'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="table-total">Total Harga Keseluruhan: Rp {{ number_format($totalHarga, 2, ',', '.') }}</h3>

        <p class="text-center">Terima kasih telah melakukan pembelian.</p>
    </div>
</body>
</html>
