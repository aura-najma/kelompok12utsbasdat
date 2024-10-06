<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
        body {
                background-image: url('assets/images/bgdokter.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                font-family: 'Poppins', sans-serif;

        }

        h2{
            padding: 1rem;
                    font-size: 35px;
                    font-weight: 600;
                    text-align: center;
                    line-height: 70px;
                    color: #fff;
                    user-select: none;
                    border-radius: 15px;
                    background: linear-gradient(-135deg, #204ae6, #36bef8);
                    margin-bottom:20px;
        }

        .navbar {
                    background: linear-gradient(-180deg,  #204ae6,#36bef8);
                }
        .navbar-brand img {
                    width: 300px;
                    height: auto;
                }
        .navbar-nav .nav-link {
                    color: white; 
                    font-weight: 600;
                    margin-right:30px;
                }

        table {
            width: 98%; /* Set the width of the table */
            border-collapse: collapse; /* Collapse borders */
            margin: 0 auto 20px; /* Center the table and add bottom margin */
            border: 1px solid #36bef8;
        }


        td {
            padding: 10px;
            text-align: left;
            background: rgba(255, 255, 255, 0.7);
        }

        th {
            padding: 10px;
            background: linear-gradient(-180deg, #204ae6, #36bef8);
            text-align: center;
            color: white;
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
    <h2>Daftar Dokter</h2>
    
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if ($dokters->isEmpty())
        <p>Tidak ada data dokter yang tersedia.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor STR</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Alamat</th>
                    <th>Hubungi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokters as $dokter)
                    <tr>
                        <td>{{ $dokter->nomor_str }}</td>
                        <td>{{ $dokter->nama_dokter }}</td>
                        <td>{{ $dokter->spesialisasi }}</td>
                        <td>{{ $dokter->alamat }}</td>
                        <td>
                            @if($dokter->hubungi)
                                <a href="{{ $dokter->hubungi }}" class="btn btn-success" target="_blank">Hubungi via WhatsApp</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
