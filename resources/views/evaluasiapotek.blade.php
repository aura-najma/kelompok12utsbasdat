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
<div class="container mt-5">
    
    <form action="/evaluasi" method="POST">
    <h1 class="text-center">Evaluasi Pelayanan Apotek</h1>

        <!-- 1. Dimensi Fasilitas Berwujud -->
        <div class="mb-4">
            <h4>1. Fasilitas Berwujud</h4>

            <label>Apotek terlihat bersih dan rapi</label>
            <select name="fasilitas_bersih_rapi" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Bagian dalam dan luar ruangan tertata dengan rapi</label>
            <select name="fasilitas_tata_ruangan" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Alat-alat yang dipakai lengkap dan bersih</label>
            <select name="fasilitas_alat_lengkap" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Petugas apotek berpakaian bersih dan rapi</label>
            <select name="fasilitas_pakaian_petugas" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

        <!-- 2. Dimensi Kehandalan -->
        <div class="mb-4">
            <h4>2. Kehandalan</h4>
            <label>Pelayanan obat cepat</label>
            <select name="kehandalan_pelayanan_cepat" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Obat tersedia dengan lengkap</label>
            <select name="kehandalan_obat_lengkap" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Harga obat sesuai</label>
            <select name="kehandalan_harga_obat" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Pelayanan ramah</label>
            <select name="kehandalan_pelayanan_ramah" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Petugas selalu siap membantu</label>
            <select name="kehandalan_petugas_bantu" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

        <!-- 3. Dimensi Ketanggapan -->
        <div class="mb-4">
            <h4>3. Ketanggapan</h4>
            <label>Petugas cepat tanggap terhadap keluhan konsumen</label>
            <select name="ketanggapan_keluhan_cepat" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Petugas solutif terhadap masalah konsumen</label>
            <select name="ketanggapan_solusi_masalah" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Terjalin komunikasi yang baik antara petugas dan konsumen</label>
            <select name="ketanggapan_komunikasi_baik" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Informasi tentang obat jelas dan mudah dimengerti</label>
            <select name="ketanggapan_info_obat" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

        <!-- 4. Dimensi Keyakinan -->
        <div class="mb-4">
            <h4>4. Keyakinan</h4>
            <label>Obat yang dibeli terjamin kualitasnya</label>
            <select name="keyakinan_obat_terjamin" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Obat yang diberikan sesuai dengan yang diminta</label>
            <select name="keyakinan_obat_sesuai" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

        <!-- 5. Dimensi Empati -->
        <div class="mb-4">
            <h4>5. Empati</h4>
            <label>Petugas memberikan pelayanan kepada semua konsumen tanpa memandang status sosial</label>
            <select name="empati_tanpa_diskriminasi" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>

            <label>Konsumen merasa nyaman selama menunggu obat</label>
            <select name="empati_nyaman_menunggu" class="form-select">
                <option value="Cukup">Cukup</option>
                <option value="Baik">Baik</option>
                <option value="Kurang">Kurang</option>
            </select>
        </div>

         <!-- 3. Progress Bar untuk penilaian -->
         <div class="mb-4">
            <h4>3. Skor Penilaian Keseluruhan</h4>
            <label>Seberapa puas Anda terhadap pelayanan apotek?</label>
            <input type="range" class="form-range" min="0" max="100" step="10" id="skor_penilaian" name="skor_penilaian">
            <div class="progress mt-3">
                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
            </div>
        </div>

        <!-- 4. Komentar -->
        <div class="mb-4">
            <h4>4. Komentar Tambahan</h4>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Berikan komentar Anda di sini" id="komentar" name="komentar" style="height: 100px;"></textarea>
                <label for="komentar">Komentar</label>
            </div>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btnbtn-primary">Kirim Evaluasi</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const slider = document.getElementById('skor_penilaian');
    const progressBar = document.querySelector('.progress-bar');
    slider.addEventListener('input', function() {
        progressBar.style.width = `${slider.value}%`;
        progressBar.textContent = `${slider.value}%`;
    });
</script>
</body>
</html>
