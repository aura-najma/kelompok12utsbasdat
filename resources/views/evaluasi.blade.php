<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pendaftaran Pasien</title>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            max-width: 500px;
            margin-top: 100px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #004080;
            text-align: center;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #004080;
            border: none;
        }
        .btn-primary:hover {
            background-color: #003366;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Pendaftaran Pasien</h3>
        
        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama Lengkap *</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Usia *</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="symptoms" class="form-label">Apa yang Mengganggu Anda? *</label>
                <textarea class="form-control" id="symptoms" name="symptoms" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
