<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(34, 149, 180, 0.2); /* Background color with 50% opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .wrapper {
            background-color: rgba(255, 255, 255);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left; /* Left align content */
        }

        h1 {
            margin-bottom: 20px;
            color: #2295b4; /* Title color */
            text-align: center;
        }

        .inputbox {
            margin-bottom: 20px;
        }

        .inputbox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #2295b4; /* Button color */
            color: white; /* Text color for button */
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: rgba(34, 149, 180, 0.8); /* Darker on hover */
        }

        /* Logo styling */
        .logo {
            display: block;
            margin: 0 auto 20px; /* Center the logo and add space below */
            width: 100px; /* Adjust the width as needed */
        }
    </style>
</head>

<body>

<div class="wrapper">
    <img src="{{ asset('img/1.png') }}" alt="Logo" class="logo"> <!-- Logo image -->
    <h1>Form Pendaftaran</h1>
    <form action="" method="POST">
        <div class="inputbox">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama" required>
        </div>
        
        <div class="inputbox">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="inputbox">
            <label for="phone">Nomor Telepon:</label>
            <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
        </div>

        <button type="submit" class="btn">Kirim</button>
    </form>
</div>

</body>
</html>
