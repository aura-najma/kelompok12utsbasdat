<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Evaluasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(34, 149, 180, 0.1);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 70%; /* Increase container width */
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Gambar */
        .image-container {
        display: flex;
        justify-content: center; /* Center the image horizontally */
        margin-bottom: 20px; /* Jarak antara gambar dan form */
        }

         .image-container img {
        max-width: 30%; 
        height: auto;
        border-radius: 10px;
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group textarea {
            width: 800px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px; /* Increase height for textarea */
        }

        .btn-submit {
            background-color: rgba(34, 149, 180);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: rgba(34, 149, 18);
        }

    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Gambar di Atas -->
        <div class="image-container">
            <img src="{{ asset('img/3.png') }}" alt="Gambar evaluasi">
        </div>

        <!-- Form Evaluasi di Bawah -->
        <div class="form-container">
            <h1>Evaluasi</h1>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="feedback">Masukan/Komentar:</label>
                    <textarea id="feedback" name="feedback" rows="4" placeholder="Masukkan masukan atau komentar Anda" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Kirim</button>
            </form>
        </div>
    </div>

</body>
</html>
