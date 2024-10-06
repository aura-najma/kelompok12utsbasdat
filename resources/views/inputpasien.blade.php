<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Tambahkan SweetAlert2 -->
    <title>Input Data Diri Pasien</title>
    <style>
        body {
            background-image: url('assets/images/bginputpasien.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            border: 1px solid lightgrey;
        }
        .text-custom {
            color: black;
            font-weight: 500;
        }

        .title {
            color: #fff;
        }

        input.form-control, 
        textarea.form-control {
            background-color: rgba(32, 74, 230, 0.1);
            border: 1px solid #204ae6;
            color: #000;
        }

        .btn-custom {
            color: white;
            width: 20%;
            padding: 10px 20px;
            border-radius:15px;
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
            margin-bottom:20px;
        }

        .navbar {
            background: linear-gradient(-180deg,  #204ae6,#36bef8);
        }
        .navbar-brand img {
            width: 300px;
            height: auto;
        }
        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right:30px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo2.png" alt="Logo">
            </a>

            <!-- Tombol Home di kanan -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="title">Input Data Diri Pembeli</h3>
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-container">
                    <form id="dataForm" action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
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

            <!-- Kolom Kanan -->
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

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-custom" style="background-color: #2295B4; color: white; width: 30%;">Submit</button>
        </div>
    </div>

    <script>
    document.getElementById('dataForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah submit form default

    const formData = new FormData(this);

    fetch('{{ route("pasien.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Menambahkan token CSRF untuk otentikasi
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // Jika respons gagal, lemparkan error dengan informasi
            return response.text().then(text => {
                throw new Error(text);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Tampilkan notifikasi jika data berhasil disimpan
            Swal.fire({
                title: 'Data Berhasil Disimpan!',
                text: 'Terima kasih telah mengisi data diri.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary', // Kustomisasi tombol
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (data.has_resep) {
                        window.location.href = '/cekobatkeras?id_pembelian=' + data.id_pembelian;
                    } else {
                        window.location.href = '/cekstokobat?id_pembelian=' + data.id_pembelian;
                    }
                }
            });
        } else {
            throw new Error(data.error || 'Terjadi kesalahan saat menyimpan data.');
        }
    })
    .catch(error => {
        // Menampilkan error yang lebih baik, mencetak kesalahan dari response text
        Swal.fire({
            title: 'Gagal Menyimpan Data',
            text: error.message,
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-danger',
            }
        });
        console.error('Error:', error);
    });
});

document.getElementById('no_telepon').addEventListener('blur', function() {
        const noTelepon = this.value.trim();

        if (noTelepon.length >= 10) {
            // Mengirimkan permintaan untuk mendapatkan data pasien
            fetch('{{ route("getPasienByNoTelepon") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ no_telepon: noTelepon })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Isi data otomatis jika pasien ditemukan
                    document.getElementById('nama').value = data.pasien.nama;
                    document.getElementById('tanggal_lahir').value = data.pasien.tanggal_lahir;
                    document.getElementById('alamat').value = data.pasien.alamat;
                    document.getElementById('alergi_obat').value = data.pasien.alergi_obat;
                } else {
                    // Kosongkan field jika pasien tidak ditemukan
                    document.getElementById('nama').value = '';
                    document.getElementById('tanggal_lahir').value = '';
                    document.getElementById('alamat').value = '';
                    document.getElementById('alergi_obat').value = '';
                    console.warn(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });



    </script>
</body>
</html>
