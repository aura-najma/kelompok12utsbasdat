<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Tambahkan SweetAlert2 -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Daftar Pasien</title>
    <style>
        body {
            background-image: url('assets/images/bginputpasien.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            color: #fff;
            font-weight: 600;
            text-align: center;
            line-height: 70px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 1rem;
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
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-weight: 600;
            margin-right: 5px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
        }

        table {
            color: #fff;
        }

        th{
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            color:#fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo2.png" alt="Logo">
            </a>

            <!-- Tombol Home di kanan -->
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
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Alergi Obat</th>
                            <th>Pembelian Pertama Kali</th>
                            <th>Aksi</th> <!-- Kolom untuk aksi edit dan delete -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping melalui setiap pasien dalam data yang dikirim -->
                        @foreach($pasienList as $pasien)
                        <tr>
                            <td>{{ $pasien->no_telepon }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->tanggal_lahir }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->alergi_obat }}</td>
                            <td>{{ $pasien->created_at }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('pasien.edit', $pasien->no_telepon) }}" class="btn btn-custom btn-primary">Edit</a>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-custom btn-danger" onclick="confirmDelete('{{ route('pasien.destroy', $pasien->no_telepon) }}')">Hapus</button>
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

    <script>
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pasien akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Membuat form untuk menghapus data
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                // Tambahkan CSRF token dan metode DELETE
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    </script>
</body>
</html>
