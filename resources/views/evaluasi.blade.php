<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Evaluasi Pelanggan</title>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #2295B4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Evaluasi Pelanggan</h3>
        <form action="{{ route('evaluasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Transaksi</label>
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
