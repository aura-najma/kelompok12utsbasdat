<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Pelayanan Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color:rgba(34, 149, 180, 0.2);
        }

        h4 {
            color: rgba(34, 149, 180);
            font-weight: bold;
        }
        h1 {
            color:rgba(34, 149, 180);
            font-weight: bold; 
            margin-bottom: 50px;
            
        }
        
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            margin-top: 15px;
            font-weight: bold; 
        }
        select, input[type="range"], textarea {
            margin-top: 10px;
        }
        .progress-bar {
            background-color: rgba(34, 149, 180);
        }
        .form-control, .form-select {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: rgba(34, 149, 180, 0.05);
            border-radius: 10px;
        }
        button {
            background-color: rgba(34, 149, 180);
            border: none;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: rgba(34, 149, 18);
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px; /* Width of the thumb */
            height: 20px; /* Height of the thumb */
            background: rgba(34, 149, 180); /* Change thumb color to yellow */
            border-radius: 50%; /* Make it round */
        }

      
    </style>

</head>
<body>
<body>
    <div class="container">
        <h3 class="text-center">Evaluasi Pelanggan</h3>
        <form action="{{ route('evaluasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Evaluasi Keadaan Apotek</label>
                <select class="form-select" name="evaluasi_apotek" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Evaluasi Pelayanan</label>
                <select class="form-select" name="evaluasi_pelayanan" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Evaluasi Pemberian Obat</label>
                <select class="form-select" name="evaluasi_obat" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="rating_apotek" class="form-label">Rating Apotek (1-10)</label>
                <input type="number" class="form-control" id="rating_apotek" name="rating_apotek" min="1" max="10" required>
            </div>
            <div class="mb-3">
                <label for="komentar" class="form-label">Komentar Tambahan</label>
                <textarea class="form-control" id="komentar" name="komentar" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim Evaluasi</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
