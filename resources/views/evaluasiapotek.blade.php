<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"> <!-- Import Poppins font -->
    <title>Evaluasi Pelanggan</title>
    <style>
        body {
            background-image: url('assets/images/bgeval.png'); /* Set background image */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Prevent repeating */
            color: #fff; /* Text color for better readability */
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to the body */
        }

        /* New class for the h2 title */
        .title {
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            line-height: 100px;
            color: #fff;
            user-select: none;
            border-radius: 15px ;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            margin-top: 0px; /* Add some space above the header */
            margin-bottom: 30px;
        }

        .form-control, .form-select {
            background-color: rgba(32, 74, 230, 0.05); /* Transparent background */
            border: 1px solid #204ae6; /* Border color */
            color: #000; /* Text color */
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to input and select fields */
        }

        .form-control:focus, .form-select:focus {
            border-color: #204ae6; /* Border color on focus */
            box-shadow: 0 0 5px rgba(32, 74, 230, 0.8); /* Shadow effect on focus */
        }

        .form-label {
            color: #204ae6; /* Label font color */
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to labels */
        }

        .note {
            color: #204ae6; /* Same color as the label */
            font-size: 0.9em; /* Smaller font size */
            font-weight: bold; /* Bold font */
        }

        .btn-primary {
            cursor: pointer;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            color: #fff; /* Text color */
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to button */
            font-weight: 600; /* Bold font for the button */
            padding: 8px 12px; /* Padding for a larger button */
            border-radius: 15px; /* Rounded corners */
            width: 20%;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for background and scale */
        }

        /* Add hover effect */
        .btn-primary:hover {
            background-color: #1a3f88; /* Darker shade on hover */
            transform: scale(1.02); /* Slightly scale up the button */
        }

        /* Optional: Add a focus effect */
        .btn-primary:focus {
            outline: none; /* Remove default outline */
            box-shadow: 0 0 5px rgba(32, 74, 230, 0.5); /* Add a shadow effect on focus */
        }

        .container {
            background-color: rgba(255, 255, 255); /* Transparent white container */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px; /* Margin from the top */
            margin-bottom: 50px;
            max-width: 600px; /* Max width of the container */
            margin-left: auto; /* Center container */
            margin-right: auto; /* Center container */
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to the entire form */
        }

        /* Style for the selected option */
        option:checked, option[selected] {
            background-color: #204ae6; /* Selected option background */
            color: white; /* Text color for selected option */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">Evaluasi Pelanggan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <form action="{{ route('evaluasi.store') }}" method="POST">
            @csrf
            @error('id_invoice')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('tanggal_transaksi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="id_invoice" class="form-label">ID Invoice *</label>
                <input type="text" class="form-control" id="id_invoice" name="id_invoice" required>
                <small class="note">ID Invoice dapat dilihat di invoice</small> <!-- Added note -->
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
                    <option value="Cukup">Cukup</option>
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
