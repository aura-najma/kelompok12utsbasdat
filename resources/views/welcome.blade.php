<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page - Apotek Dawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('img/2.png') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: white; 
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
        }
        .navbar-brand {
            color: #0056b3; 
            font-weight: 600;
            font-size: 1.5rem; 
            margin-left: 20px; 
        }
        .navbar-text {
            color: #0056b3; 
            font-weight: 300;
            font-size: 1.2rem; 
        }
        .welcome-container {
            display: flex;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            max-width: 1000px; 
            margin: auto;
        }
        .left-section {
            flex: 1;
            margin-right: 40px; 
        }
        .right-section {
            flex: 1;
        }
        .welcome-title {
            color: #2295b4; 
            font-weight: 600;
            font-size: 2rem; 
        }
        .text-custom {
            color: #2295b4; 
        }
        .button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2295b4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .history-image {
            max-width: 100%; 
            border-radius: 10px;
        }
        .welcome-image {
            max-width: 100%; 
            border-radius: 10px;
            margin: 20px 0; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand">Apotek Dawai</a>
            <span class="navbar-text">
                Sahabat Sehat Selalu
            </span>
        </div>
    </nav>

    <!-- Welcome Box -->
    <div class="welcome-container">
        <div class="left-section">
            <h1 class="welcome-title">Welcome to Apotek Dawai</h1>
            <img src="https://expertindo-training.com/wp-content/uploads/2023/10/Screenshot-2023-10-12-145346.jpg" alt="Welcome" class="welcome-image">
            <a href="{{ route('login') }}" class="button">Login</a>
            <button type="button" class="button" onclick="window.location.href='evaluasiapotek'">Evaluasi Apotek</button>
        </div>
        <div class="right-section">
            <h2 class="text-custom">APOTEK DAWAI</h2>
            <p>Alamat: Jl. Kesehatan No. 123, Surabaya</p>
            <p>Apotek Dawai telah melayani masyarakat sejak tahun 2005 dengan berbagai produk kesehatan dan layanan yang berkualitas.</p>
            <img src="https://asset-a.grid.id/crop/0x0:0x0/x/photo/2019/07/02/2384103658.png" alt="Lokasi Apotek" class="history-image">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
