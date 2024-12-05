<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Daftar Pasien</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 1px solid lightgrey;
        }

        .title {
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
            font-family: 'Poppins', sans-serif;
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

        .btn-custom {
            padding: 5px 10px;
            border-radius: 15px;
            border: 1px solid transparent; 
            font-weight: 600;
            font-size: 20px;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: white; 
            border: 1px solid green; 
            color: green; 
        }

        .btn-edit:hover {
            background-color: green; 
            color: white; 
        }

        table {
            color: #fff;
        }

        th {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
            vertical-align: top;
            color: #fff;
            text-align: center;
            border: 1px solid #fff;
            vertical-align: middle; 
        }

        td {
            padding: 10px;
            text-align: center;
            border: none;
            color: #000; 
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 1px solid lightgrey;
            transition: transform 0.3s; 
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo2.png" alt="Logo">
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="title">Daftar Pasien</h3>
        <div class="table-container">
            @if($pasienList->isNotEmpty())
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No Telepon</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Alergi Obat</th>
                            <th>Kecamatan</th> <!-- Menambahkan kolom Kecamatan -->
                            <th>Pembelian Pertama Kali</th>
                            <th>Aksi</th> <!-- Kolom untuk aksi edit -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pasienList as $pasien)
                        <tr>
                            <td>{{ $pasien->no_telepon }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->jenis_kelamin }}</td> <!-- Menampilkan jenis kelamin -->
                            <td>{{ $pasien->tanggal_lahir }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->alergi_obat }}</td>
                            <td>{{ $pasien->kecamatan ? $pasien->kecamatan->Kecamatan : 'Tidak Diketahui' }}</td> <!-- Menampilkan nama kecamatan -->
                            <td>{{ $pasien->created_at }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('pasien.edit', $pasien->no_telepon) }}" class="btn btn-edit">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Tidak ada pasien yang tersedia saat ini.</p>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        // Apply the filter
        table.columns().every(function() {
            var that = this;

            $('input', this.header()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    </script>
</body>
</html>
