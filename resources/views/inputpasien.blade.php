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
            background-color: white; /* Kontainer putih */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .text-custom {
            color: #2295B4; /* Teks berwarna biru */
        }
    </style>
</head>
<body>
            <!-- BASE YANG DIPAKE CONTROLLER DAN MODEL PASIEN-->
    <div class="form-container mt-5">
        <h3 class="text-custom text-center">Input Data Diri Pembeli</h3>
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
            
            <!-- Keluhan Field -->
            <div class="mb-3">
                <label for="keluhan" class="form-label text-custom">Keluhan</label>
                <textarea class="form-control" id="keluhan" name="keluhan" rows="3"></textarea>
            </div>
            
            <!-- Alergi Obat Field -->
            <div class="mb-3">
                <label for="alergi_obat" class="form-label text-custom">Alergi Obat</label>
                <textarea class="form-control" id="alergi_obat" name="alergi_obat" rows="3"></textarea>
            </div>
            
            <!-- Upload Resep Field -->
            <div class="mb-3">
                <label for="resep" class="form-label text-custom">Upload Resep</label>
                <input type="file" class="form-control" id="resep" name="resep" accept=".jpg,.jpeg,.png">
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom w-100" style="background-color: #2295B4; color: white;">Submit</button>
        </form>
    </div>

    <script>
    function fetchPasienData() {
        const noTelepon = document.getElementById('no_telepon').value;

        if (noTelepon) {
            fetch(`/get-pasien?no_telepon=${noTelepon}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Isi field form dengan data pasien lama
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('tanggal_lahir').value = data.tanggal_lahir;
                        document.getElementById('alamat').value = data.alamat;
                        document.getElementById('alergi_obat').value = data.alergi_obat;
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
                    <!-- BASE YANG DIPAKE CONTROLLER DAN MODEL PASIEN-->

</body>
</html>
