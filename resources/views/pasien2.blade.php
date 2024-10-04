<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(34, 149, 180, 0.5); /* Background color with 50% opacity */
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
    <p>Anda belum pernah berobat, silahkan isi data lengkap anda</p>
    <h1>Form Pendaftaran</h1>
    <form action="" method="POST">
        
        <div class="inputbox">
            <label for="dob">Tanggal Lahir:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
    
        <div class="inputbox">
            <label for="rt_rw">RT/RW:</label>
            <input type="text" id="rt_rw" name="rt_rw" placeholder="RT/RW" required>
        </div>
        <div class="inputbox">
            <label for="kelurahan">Kelurahan/Desa:</label>
            <input type="text" id="kelurahan" name="kelurahan" placeholder="Kelurahan/Desa" required>
        </div>
        <div class="inputbox">
            <label for="kecamatan">Kecamatan:</label>
            <input type="text" id="kecamatan" name="kecamatan" placeholder="Kecamatan" required>
        </div>
        <div class="inputbox">
            <label for="kota">Kota/Kabupaten:</label>
            <input type="text" id="kota" name="kota" placeholder="Kota/Kabupaten" required>
        </div>
        <div class="inputbox">
            <label for="provinsi">Provinsi:</label>
            <input type="text" id="provinsi" name="provinsi" placeholder="Provinsi" required>
        </div>
        <button type="submit" class="btn">Kirim</button>
    </form>
</div>

</body>
</html>
