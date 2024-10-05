<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Evaluasi Pelanggan</title>
    <style>
        body {
            background-image: url('assets/images/bgeval.png'); /* Set background image */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Prevent repeating */
            color: #fff; /* Text color for better readability */
        }
        h2 {
            color: #204ae6; /* Header color */
            margin-top: 20px; /* Add some space above the header */
        }
        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            border: 1px solid #204ae6; /* Thin border with blue color */
            color: #000; /* Text color for input fields */
        }
        .form-control:focus, .form-select:focus {
            border-color: #204ae6; /* Border color on focus */
            box-shadow: 0 0 5px rgba(32, 74, 230, 0.8); /* Add shadow on focus */
        }
        .form-label {
            color: #204ae6; /* Label font color */
        }
        .btn-primary {
            background-color: #204ae6; /* Button color */
            border-color: #204ae6; /* Button border color */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Transparent white container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px; /* Spacing from top */
        }
        /* Style for the selected option */
        option:checked, option[selected] {
            background-color: #204ae6; /* Transparent black background */
            color: white; /* Text color for selected option */
        }


    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Evaluasi Pelanggan</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('evaluasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli *</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi *</label>
                <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kebersihan dan kerapian apotek *</label>
                <select class="form-select" name="evaluasi_apotek" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Apoteker dan staff melayani dengan baik dan menerapkan 3S (senyum, salam, sapa)*</label>
                <select class="form-select" name="evaluasi_pelayanan" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Obat yang diberikan sesuai yang diminta, tidak lewat expired dan bersegel *</label>
                <select class="form-select" name="evaluasi_obat" required>
                    <option value="" disabled selected>Pilih evaluasi</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup">Cukup</</option>
                    <option value="Buruk">Buruk</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="rating_apotek" class="form-label">Rating Apotek (1-10) *</label>
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
