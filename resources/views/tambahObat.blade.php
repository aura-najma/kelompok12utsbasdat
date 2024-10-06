<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Obat Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid lightgrey;
            margin-bottom: 2rem;
            height:100%;
        }

        .text-custom {
            color: black;
            font-weight: 500;
        }

        .title {
            color: #fff;
        }

        input.form-control,
        textarea.form-control,
        select.form-control {
            background-color: rgba(32, 74, 230, 0.1);
            border: 1px solid #204ae6;
            color: #000;
        }

        .btn-custom {
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            font-weight: 600;
        }

        h3 {
            padding: 1rem;
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            line-height: 70px;
            color: #fff;
            user-select: none;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            margin-bottom: 20px;
        }

        .navbar {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
        }

        .navbar-brand img {
            width: 300px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right: 30px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo">
            </a>

            <!-- Tombol Home di kanan -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Dasboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="title">Tambah Obat Baru</h3>
        <form id="tambahObatForm" action="{{ url('/lihatstokobat/tambah-obat') }}" method="POST">
            @csrf <!-- Token CSRF untuk keamanan -->
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-container">
                        <!-- No BPOM Field -->
                        <div class="mb-3">
                            <label for="no_bpom" class="form-label text-custom">No BPOM</label>
                            <input type="text" class="form-control" id="no_bpom" name="no_bpom" required>
                        </div>

                        <!-- Nama Obat Field -->
                        <div class="mb-3">
                            <label for="nama" class="form-label text-custom">Nama Obat</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <!-- Kategori Field -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label text-custom">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Asma">Asma</option>
                                <option value="Batuk & Pilek">Batuk & Pilek</option>
                                <option value="Perawatan dan Gangguan Kulit">Perawatan dan Gangguan Kulit</option>
                                <option value="Pusing & Demam">Pusing & Demam</option>
                                <option value="Pencernaan">Pencernaan</option>
                                <option value="Diabetes">Diabetes</option>
                                <option value="Jantung">Jantung</option>
                                <option value="THT">THT</option>
                                <option value="Mata">Mata</option>
                                <option value="Sistem Saluran Kemih">Sistem Saluran Kemih</option>
                                <option value="Hormonal">Hormonal</option>
                            </select>
                        </div>

                        <!-- Jenis Obat Field -->
                        <div class="mb-3">
                            <label for="jenis_obat" class="form-label text-custom">Jenis Obat</label>
                            <select class="form-control" id="jenis_obat" name="jenis_obat" required>
                                <option value="" disabled selected>Pilih Jenis Obat</option>
                                <option value="Keras">Keras</option>
                                <option value="Bebas Terbatas">Bebas Terbatas</option>
                                <option value="Bebas">Bebas</option>
                            </select>
                        </div>

                        <!-- Stok Field -->
                        <div class="mb-3">
                            <label for="stok" class="form-label text-custom">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="1" required>
                        </div>

                        <!-- Tanggal Kadaluwarsa Field -->
                        <div class="mb-3">
                            <label for="tanggal_kadaluwarsa" class="form-label text-custom">Tanggal Kadaluwarsa</label>
                            <input type="date" class="form-control" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" required>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-container">
                        <!-- Harga Satuan Field -->
                        <div class="mb-3">
                            <label for="harga_satuan" class="form-label text-custom">Harga Satuan</label>
                            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" min="1" required>
                        </div>

                        <!-- Kategori Obat Keras Field -->
                        <div class="mb-3">
                            <label for="kategori_obat_keras" class="form-label text-custom">Kategori Obat Keras</label>
                            <select class="form-control" id="kategori_obat_keras" name="kategori_obat_keras">
                                <option value="">Pilih Kategori Obat Keras</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="X">X</option>
                                <option value="Bukan Obat Keras">Bukan Obat Keras</option>
                            </select>
                        </div>

                        <!-- Dosis Field -->
                        <div class="mb-3">
                            <label for="dosis" class="form-label text-custom">Dosis</label>
                            <textarea class="form-control" id="dosis" name="dosis" required></textarea>
                        </div>

                        <!-- Aturan Pakai Field -->
                        <div class="mb-3">
                            <label for="aturan_pakai" class="form-label text-custom">Aturan Pakai</label>
                            <textarea class="form-control" id="aturan_pakai" name="aturan_pakai" required></textarea>
                        </div>

                        <!-- Rute Obat Field -->
                        <div class="mb-3">
                            <label for="rute_obat" class="form-label text-custom">Rute Obat</label>
                            <select class="form-control" id="rute_obat" name="rute_obat" required>
                                <option value="">Pilih Rute Obat</option>
                                <option value="Oral">Oral</option>
                                <option value="Sublingual dan Buccal">Sublingual dan Buccal</option>
                                <option value="Suntikan">Suntikan</option>
                                <option value="Topikal">Topikal</option>
                                <option value="Rektal">Rektal</option>
                                <option value="Okular">Okular</option>
                                <option value="Nasal">Nasal</option>
                                <option value="Nebulisasi">Nebulisasi</option>
                                <option value="Inhalasi">Inhalasi</option>
                            </select>
                        </div>

                       

                        <!-- Tampilkan pesan sukses atau error (jika ada) -->
                        @if (session('message'))
                            <div class="alert alert-success mt-3 text-center">
                                {{ session('message') }}
                            </div>
                        @endif

        
                    </div>
                </div>
            </div>

        </form>
         <!-- Submit Button -->
         <div class="text-center mt-4">
                            <button type="submit" class="btn btn-custom">Tambah Obat</button>
                        </div>
    </div>

</body>
</html>
