<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Healthcare Apotek</title>
    
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1xJb/tjI3MQ2kI5" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('img/2.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Background blur and black transparent overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); 
        }

        /* Navigation bar */
        .navbar-custom {
            position: absolute;
            top: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 10px 0;
            display: flex;
            justify-content: flex-start;
            z-index: 1;
        }

        /* Title on the left */
        .navbar-custom h1 {
            margin-left: 20px;
            color: rgba(43, 138, 240);
            font-size: 24px;
            font-weight: bold;
        }

        /* Main content */
        .siapaanda {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: white;
        }

        p {
            color: white;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar-custom">
       <h1>SemogaSehat</h1>
    </div>

    <!-- Main Content -->
    <div class="siapaanda">
        <h1>Welcome to Apotek Dawai</h1>
        <p>Siapakah Anda?</p>
        <div class="button-container">
            <a href="{{ route('login') }}" class="button">Apoteker</a>
            <a href="{{ route('pasien') }}" class="button">Pasien</a>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93gkzXZrCC3r56SBe5W25S5qEuwI0ztuqGsWZVNZET4RYyzG1pF47VylgjANM7" crossorigin="anonymous"></script>
    
</body>
</html>
