<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Detail</title>
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
    <h1>Invoice Detail</h1>
    <p>ID Invoice: {{ $idInvoice }}</p>

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
            @foreach($invoiceData as $invoice)
            <tr>
                <td>{{ $invoice->nama_obat }}</td>
                <td>{{ $invoice->jumlah }}</td>
                <td>{{ number_format($invoice->harga_satuan, 2) }}</td>
                <td>{{ number_format($invoice->harga_total, 2) }}</td>
                <td>{{ $invoice->dosis }}</td>
                <td>{{ $invoice->aturan_pakai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Harga Keseluruhan: Rp {{ number_format($totalHarga, 2) }}</h3>

    <p>Terima kasih telah melakukan pembelian.</p>
</body>
</html>
