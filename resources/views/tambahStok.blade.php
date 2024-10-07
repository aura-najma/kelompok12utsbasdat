<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Obat</title>
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

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid lightgrey;
            margin-bottom: 2rem;
            height:100%;
        }

        .text-custom {
            color: black;
            font-weight: 500;
        }

        .title {
            color: #fff;
        }

        input.form-control,
        textarea.form-control,
        select.form-control {
            background-color: rgba(32, 74, 230, 0.1);
            border: 1px solid #204ae6;
            color: #000;
        }

        .btn-custom {
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            font-weight: 600;
        }

        h3 {
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="title">Tambah Stok Obat</h3>
        <div class="row">
            <!-- Kolom Kiri: Form Tambah Stok -->
            <div class="col-md-6">
                <div class="form-container">
                    <!-- Form untuk menambah stok obat -->
                    <form action="{{ url('/lihatstokobat/tambah-stok') }}" method="POST">
                        @csrf <!-- Token CSRF untuk keamanan -->

                        <!-- No BPOM Field -->
                        <div class="mb-3">
                            <label for="no_bpom" class="form-label text-custom">No BPOM</label>
                            <input type="text" class="form-control" id="no_bpom" name="no_bpom" required>
                        </div>

                        <!-- Jumlah Stok Field -->
                        <div class="mb-3">
                            <label for="stok" class="form-label text-custom">Jumlah Stok yang Ditambahkan</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="1" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-custom">Tambah Stok</button>
                        </div>
                    </form>

                    <!-- Tampilkan pesan sukses atau error (jika ada) -->
                    @if (session('message'))
                        <div class="alert alert-success mt-3 text-center">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Obat dengan Stok Rendah -->
            <div class="col-md-6">
                <div class="form-container">
                    <h4 class="text-custom">Obat dengan Stok Rendah</h4>
                    @if($lowStockObatList->isNotEmpty())
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No BPOM</th>
                                    <th>Nama Obat</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockObatList as $obat)
                                    <tr>
                                        <td>{{ $obat->no_bpom }}</td>
                                        <td>{{ $obat->nama }}</td>
                                        <td>{{ $obat->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-custom">Tidak ada obat dengan stok rendah saat ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>
