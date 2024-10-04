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
            background-color: white;
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

        p {
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
    <h1>Form Pembelian Obat</h1>
    <form action="" method="POST" enctype="multipart/form-data"> <!-- Jangan lupa tambahkan enctype -->
    
    
        <!-- Form informasi pembelian -->
        <div class="inputbox">
            <label for="keluhan">Keluhan:</label>
            <input type="text" id="keluhan" name="keluhan" placeholder="Keluhan" required>
        </div>

        <div class="inputbox">
            <label for="obat">Obat:</label>
            <input type="text" id="obat" name="obat" placeholder="Nama Obat" required>
        </div>

        <div class="inputbox">
            <label>Ada resep?</label>
            <div style="display: flex; gap: 20px;"> <!-- Flexbox untuk mengatur elemen dalam satu baris -->
                <label>
                    <input type="radio" id="resep_ya" name="resep" value="ya" required>
                    Ya
                </label>
                <label>
                    <input type="radio" id="resep_tidak" name="resep" value="tidak">
                    Tidak
                </label>
            </div>
        </div>

        <div class="inputbox">
            <label for="upload_resep">Upload Resep (PNG/JPG):</label>
            <input type="file" id="upload_resep" name="upload_resep" accept=".png,.jpg,.jpeg">
        </div>
        

        
        <button type="submit" class="btn">Kirim</button>
    </form>
</div>

</body>
</html>
