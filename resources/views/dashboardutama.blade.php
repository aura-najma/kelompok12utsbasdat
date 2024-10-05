<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard Apoteker</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
        }
        .sidebar {
            height: 100vh;
            background-color: white;
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .sidebar h4 {
            color: #2295B4;
            margin-bottom: 1rem;
        }
        .nav-link {
            color: #2295B4;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .nav-link:hover {
            background-color: rgba(34, 149, 180, 0.1);
            text-decoration: none;
        }
        .content {
            padding: 2rem;
        }
        .profile {
            margin-bottom: 1rem;
            text-align: center;
        }
        .profile img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 0.5rem;
        }
        .logout-btn {
            background-color: #a4c757;
            color: white;
            border: none;
        }
        .logout-btn:hover {
            background-color: #8fb54b;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar">
        <div class="profile">
            <img src="https://via.placeholder.com/100" alt="Foto Apoteker">
            <h5>Selamat Datang, {{ $nip }}</h5>
            <p>No Registrasi: {{ $nip == 'Dyah Ayu' ? 'STR1234567890' : 'STR0987654321' }}</p>
        </div>
        <h4 class="text-center">Dashboard Apoteker</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="/cekstokobat">Cek Stok Obat</a>
            <a class="nav-link" href="/validasidokter">Validasi Dokter</a>
            <a class="nav-link" href="/inputpasien">Pembelian Obat</a>
            <a class="nav-link" href="/analisispenjualan">Analisis Penjualan</a>
            <a class="nav-link" href="/daftar-pasien">Daftar Pasien</a>
            <a class="nav-link" href="/lihatstokobat">Lihat Stok Obat</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn logout-btn w-100 mt-3">Logout</button>
        </form>
    </div>
    <div class="content flex-grow-1">
        <h2>Selamat Datang di Dashboard Apoteker</h2>
        <p>Di sini Anda dapat mengelola data obat, pasien, dan analisis penjualan.</p>
    </div>
</div>
</body>
</html>
