<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Tambahkan SweetAlert2 -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- Link to Poppins font -->
    <title>Edit Data Pasien</title>
    <style>
        body {
            background-image: url('assets/images/bginputpasien.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid lightgrey;
            margin-top: 30px;
        }

        .title {
            color: #fff;
            font-weight: 600;
            text-align: center;
            line-height: 70px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 1rem;
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

        .btn-custom {
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            margin-right: 10px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
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
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="title">Edit Data Pasien</h3>
        <div class="form-container">
            <!-- Formulir untuk mengedit data pasien -->
            <form action="{{ route('pasien.update', $pasien->no_telepon) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- No Telepon Field -->
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon:</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $pasien->no_telepon }}" readonly>
                </div>

                <!-- Nama Field -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}" readonly>
                </div>
                <!-- Jenis Kelamin Field (Read-only) -->
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $pasien->jenis_kelamin }}" readonly>
                </div>
                <!-- Tanggal Lahir Field -->
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" readonly>
                </div>

                <!-- Alamat Field -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $pasien->alamat }}</textarea>
                </div>

                <!-- Alergi Obat Field -->
                <div class="mb-3">
                    <label for="alergi_obat" class="form-label">Alergi Obat:</label>
                    <textarea class="form-control" id="alergi_obat" name="alergi_obat" rows="3">{{ $pasien->alergi_obat }}</textarea>
                </div>

                <!-- Kecamatan Dropdown -->
                <div class="mb-3">
                    <label for="nama_kecamatan" class="form-label">Kecamatan:</label>
                    <select class="form-control" id="nama_kecamatan" name="nama_kecamatan" required>
                        <option value="" disabled selected>Pilih Kecamatan</option>
                        <option value="Asemrowo" {{ $pasien->kecamatan == 'Asemrowo' ? 'selected' : '' }}>Asemrowo</option>
                        <option value="Jambangan" {{ $pasien->kecamatan == 'Jambangan' ? 'selected' : '' }}>Jambangan</option>
                        <option value="Karang Pilang" {{ $pasien->kecamatan == 'Karang Pilang' ? 'selected' : '' }}>Karang Pilang</option>
                        <option value="Kenjeran" {{ $pasien->kecamatan == 'Kenjeran' ? 'selected' : '' }}>Kenjeran</option>
                        <option value="Krembangan" {{ $pasien->kecamatan == 'Krembangan' ? 'selected' : '' }}>Krembangan</option>
                        <option value="Lakarsantri" {{ $pasien->kecamatan == 'Lakarsantri' ? 'selected' : '' }}>Lakarsantri</option>
                        <option value="Mulyorejo" {{ $pasien->kecamatan == 'Mulyorejo' ? 'selected' : '' }}>Mulyorejo</option>
                        <option value="Pabean Cantian" {{ $pasien->kecamatan == 'Pabean Cantian' ? 'selected' : '' }}>Pabean Cantian</option>
                        <option value="Pakal" {{ $pasien->kecamatan == 'Pakal' ? 'selected' : '' }}>Pakal</option>
                        <option value="Rungkut" {{ $pasien->kecamatan == 'Rungkut' ? 'selected' : '' }}>Rungkut</option>
                        <option value="Sambikerep" {{ $pasien->kecamatan == 'Sambikerep' ? 'selected' : '' }}>Sambikerep</option>
                        <option value="Benowo" {{ $pasien->kecamatan == 'Benowo' ? 'selected' : '' }}>Benowo</option>
                        <option value="Sawahan" {{ $pasien->kecamatan == 'Sawahan' ? 'selected' : '' }}>Sawahan</option>
                        <option value="Semampir" {{ $pasien->kecamatan == 'Semampir' ? 'selected' : '' }}>Semampir</option>
                        <option value="Simokerto" {{ $pasien->kecamatan == 'Simokerto' ? 'selected' : '' }}>Simokerto</option>
                        <option value="Sukolilo" {{ $pasien->kecamatan == 'Sukolilo' ? 'selected' : '' }}>Sukolilo</option>
                        <option value="Sukomanunggal" {{ $pasien->kecamatan == 'Sukomanunggal' ? 'selected' : '' }}>Sukomanunggal</option>
                        <option value="Tambaksari" {{ $pasien->kecamatan == 'Tambaksari' ? 'selected' : '' }}>Tambaksari</option>
                        <option value="Tandes" {{ $pasien->kecamatan == 'Tandes' ? 'selected' : '' }}>Tandes</option>
                        <option value="Tegalsari" {{ $pasien->kecamatan == 'Tegalsari' ? 'selected' : '' }}>Tegalsari</option>
                        <option value="Tenggilis Mejoyo" {{ $pasien->kecamatan == 'Tenggilis Mejoyo' ? 'selected' : '' }}>Tenggilis Mejoyo</option>
                        <option value="Wiyung" {{ $pasien->kecamatan == 'Wiyung' ? 'selected' : '' }}>Wiyung</option>
                        <option value="Bubutan" {{ $pasien->kecamatan == 'Bubutan' ? 'selected' : '' }}>Bubutan</option>
                        <option value="Wonocolo" {{ $pasien->kecamatan == 'Wonocolo' ? 'selected' : '' }}>Wonocolo</option>
                        <option value="Wonokromo" {{ $pasien->kecamatan == 'Wonokromo' ? 'selected' : '' }}>Wonokromo</option>
                        <option value="Bulak" {{ $pasien->kecamatan == 'Bulak' ? 'selected' : '' }}>Bulak</option>
                        <option value="Dukuh Pakis" {{ $pasien->kecamatan == 'Dukuh Pakis' ? 'selected' : '' }}>Dukuh Pakis</option>
                        <option value="Gayungan" {{ $pasien->kecamatan == 'Gayungan' ? 'selected' : '' }}>Gayungan</option>
                        <option value="Genteng" {{ $pasien->kecamatan == 'Genteng' ? 'selected' : '' }}>Genteng</option>
                        <option value="Gubeng" {{ $pasien->kecamatan == 'Gubeng' ? 'selected' : '' }}>Gubeng</option>
                        <option value="Gunung Anyar" {{ $pasien->kecamatan == 'Gunung Anyar' ? 'selected' : '' }}>Gunung Anyar</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-custom" style="background-color: #2295B4;">Simpan Perubahan</button>
                    <a href="{{ route('daftarPasien') }}" class="btn btn-custom btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
