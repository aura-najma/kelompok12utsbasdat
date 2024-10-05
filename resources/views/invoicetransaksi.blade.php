<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian Obat</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Invoice Pembelian Obat</h1>
    <p>ID Pembelian: {{ $idPembelian }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
                <th>Dosis</th>
                <th>Aturan Pakai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiData as $transaksi)
            <tr>
                <td>{{ $transaksi['nama_obat'] }}</td>
                <td>{{ $transaksi['jumlah_obat'] }}</td>
                <td>{{ number_format($transaksi['harga_satuan'], 2) }}</td>
                <td>{{ number_format($transaksi['harga_total'], 2) }}</td>
                <td>{{ $transaksi['dosis'] }}</td>
                <td>{{ $transaksi['aturan_pakai'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Harga Keseluruhan: Rp {{ number_format($totalHarga, 2) }}</h3>

    <p>Terima kasih telah melakukan pembelian.</p>
</body>
</html>
