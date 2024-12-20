<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Stok Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid lightgrey;
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
            font-family: 'Poppins', sans-serif;
        }

        .low-stock {
            background-color: rgba(255, 182, 193, 0.9)!important; 
        }

        table.dataTable tbody tr {
            background-color: #FFFFFF; /* Warna putih untuk baris tabel kecuali low-stock */
        }

        input.form-control, 
        textarea.form-control {
            background-color: rgba(32, 74, 230, 0.1);
            border: 1px solid #204ae6;
            color: #000;
            font-family: 'Poppins', sans-serif;
        }

        .btn-custom {
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }

        .dataTables_wrapper {
            width: 110%;
            margin: 0 auto;
        }

        table {
            width: 100% !important;
            font-family: 'Poppins', sans-serif;
            border-collapse: collapse;
        }

        th {
            vertical-align: top;
            background-color: #2461e9!important;
            color: #fff;
            text-align: center;
            border:1px solid #fff;
            vertical-align: middle; 
        }

        td {
            padding: 10px;
            
            text-align: center;
            border:none;
            
        }

        .container {
            max-width: 100% !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo">
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
        
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/lihatstokobat/tambah-stok') }}">Tambah Stok Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/lihatstokobat/tambah-obat') }}">Tambah Obat Baru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboardutama') }}">Dasboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="title">Daftar Stok Obat</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="form-container">
        @if($obatList->isNotEmpty())
            <div class="table-responsive">
                <table id="obatTable" class="table table-bordered table-hover table-striped w-100">
                    <thead class="table-primary">
                        <tr>
                            <th>No BPOM</th>
                            <th>Nama Obat</th>
                            <th>Kategori</th>
                            <th>Jenis Obat</th>
                            <th>Stok</th>
                            <th>Harga Satuan</th>
                            <th>Kategori Obat Keras</th>
                            <th>Dosis</th>
                            <th>Aturan Pakai</th>
                            <th>Rute Obat</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach($obatList as $obat)
                        <tr @if($obat->stok < 5) class="low-stock" @endif>
                            <td>{{ $obat->no_bpom }}</td>
                            <td>{{ $obat->nama }}</td>
                            <td>{{ $obat->kategori }}</td>
                            <td>{{ $obat->jenis_obat }}</td>
                            <td>{{ $obat->stok }}</td>
                            <td>Rp{{ number_format($obat->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ $obat->kategori_obat_keras }}</td>
                            <td>{{ $obat->dosis }}</td>
                            <td>{{ $obat->aturan_pakai }}</td>
                            <td>{{ $obat->rute_obat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                Tidak ada obat yang tersedia saat ini.
            </div>
        @endif

    
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        let table = $('#obatTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json"
            }
        });

        // Apply the filter
        table.columns().every(function() {
            var that = this;

            $('input', this.header()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>

</body>
</html>
