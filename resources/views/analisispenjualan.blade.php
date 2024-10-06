<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Penjualan</title>
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
            text-align: center;
        }

        h1 {
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

        p {
            font-size: 1.2rem;
            color: #204ae6;
            font-weight: 600;
        }

        footer {
            background: linear-gradient(-180deg, #36bef8, #204ae6);
            text-align: center;
            margin-top: 50px;
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

    <!-- Container untuk Analisis Penjualan -->
    <div class="container">
        <h1>Analisis Penjualan</h1>
        <p>Belum Tersedia</p>
    </div>


</body>
</html>
