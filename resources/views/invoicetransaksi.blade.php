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
            background-size: 100%;
            background-position: bottom center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            justify-content: flex-end;
            min-height: 100vh;
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

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
            border: 1px solid lightgrey;
            max-width: 800px;
        }

        h1{
            padding: 1rem;
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            line-height: 70px;
            color: #fff;
            user-select: none;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            margin-bottom: 20px;
            
        }

        
        h3 {
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

        td {
            padding: 15px;
            text-align: left;
            
        }

        th {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
            color: #ffffff; /* Teks tetap putih karena background sudah lebih gelap */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            text-align: center;
            vertical-align: middle; 
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

        footer {
            background: linear-gradient(-180deg, #36bef8,#204ae6);
            text-align: center;
            margin-top: 50px; /* Memastikan footer berada di bawah konten */
            padding: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 200;
            vertical-align: middle; 
        }
    </style>
</head>
<body>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo">
            </a>

            <!-- Tombol Home di kanan -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Dasboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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

   <!-- Footer -->
   <footer>
       
        <p>Semoga Sehat Selalu❤️</p>
    </footer>
   
</body>
</html>
