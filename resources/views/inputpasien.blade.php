<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Input Data Diri Pasien</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
        }
        .form-container {
            background-color: white; 
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 100%; /* Memastikan tinggi container kolom sama */
        }
        .text-custom {
            color: black;
            font-weight: 500;
        }

        .title {
            color: #fff;
        }

        .btn-custom {
            color: white;
            width: 20%;
            padding: 10px 20px; /* Tambahkan padding di sini */
            border-radius:15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
        }

        h3 {
            padding: 1rem; /* Menambahkan padding pada h3 */
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            line-height: 70px;
            color: #fff;
            user-select: none;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            margin-bottom:20px;
            
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="title">Input Data Diri Pembeli</h3>
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-container">
                    <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token untuk melindungi dari CSRF -->
                        
                        <!-- Nama Field -->
                        <div class="mb-3">
                            <label for="nama" class="form-label text-custom">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        
                        <!-- Tanggal Lahir Field -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label text-custom">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        
                        <!-- Alamat Field -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label text-custom">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        
                        <!-- Nomor Telepon Field -->
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label text-custom">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" pattern="[0-9]{10,15}" required>
                        </div>
                </div>
            </div>

            <!-- Kolom Kanan (Digabungkan dalam 1 Container) -->
            <div class="col-md-6">
                <div class="form-container">
                    <div class="mb-3">
                        <label for="keluhan" class="form-label text-custom">Keluhan</label>
                        <textarea class="form-control" id="keluhan" name="keluhan" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alergi_obat" class="form-label text-custom">Alergi Obat</label>
                        <textarea class="form-control" id="alergi_obat" name="alergi_obat" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="resep" class="form-label text-custom">Upload Resep</label>
                        <input type="file" class="form-control" id="resep" name="resep" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button di Tengah -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-custom" style="background-color: #2295B4; color: white; width: 30%;">Submit</button>
        </div>
    </div>

    <script>
    function fetchPasienData() {
        const noTelepon = document.getElementById('no_telepon').value;

        if (noTelepon) {
            fetch(`/get-pasien?no_telepon=${noTelepon}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Data pasien:', data); // Cek data yang diterima

                    if (data) {
                        // Isi field form dengan data pasien lama
                        document.getElementById('nama').value = data.nama || '';
                        document.getElementById('tanggal_lahir').value = data.tanggal_lahir || '';
                        document.getElementById('alamat').value = data.alamat || '';
                        document.getElementById('alergi_obat').value = data.alergi_obat || '';
                    } else {
                        // Kosongkan field jika data pasien tidak ditemukan
                        document.getElementById('nama').value = '';
                        document.getElementById('tanggal_lahir').value = '';
                        document.getElementById('alamat').value = '';
                        document.getElementById('alergi_obat').value = '';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
    </script>
</body>
</html>
