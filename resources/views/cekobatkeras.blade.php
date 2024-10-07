<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Obat Keras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .navbar {
            background: linear-gradient(-180deg,  #204ae6,#36bef8);
        }
        .navbar-brand img {
            width: 200px;
            height: auto;
        }
        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right:30px;
        }

        h2 {
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

        /* Form Styling */
        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            transition: border 0.3s ease;
        }

        .form-control:focus {
            border-color: #36bef8;
            outline: none;
        }

        .btn {
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(-135deg,  #204ae6,#36bef8);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1637b5;
        }

        .btn-warning {
            background-color: #ffcc00;
            color: #333;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e6b800;
        }

        /* Obat Validation Styles */
        .validasi-container {
            background-color: #fff3cd;
            padding: 10px;
            border-radius: 10px;
            border-left: 5px solid #ffa000;
            display: none;
            margin-top: 10px;
        }

        .validasi-container strong {
            color: #ff5722;
        }

        .non-obat-keras {
            background-color: #d4edda;
            padding: 10px;
            border-radius: 10px;
            border-left: 5px solid #28a745;
            display: none;
            margin-top: 10px;
        }

        .non-obat-keras strong {
            color: #28a745;
        }

        /* Add Obat Button */
        #btn-tambah-obat {
            background-color: #fff; /* Background putih */
            color: #36bef8; /* Warna teks biru */
            border: 2px solid #36bef8; /* Batas tombol biru */
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 30px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Hover effect */
        #btn-tambah-obat:hover {
            background-color: #36bef8; /* Ubah background menjadi biru saat hover */
            color: white; /* Ubah warna teks menjadi putih saat hover */
        }

        /* Stock Check Button */
        #btn-cek-stok-obat {
            background-color: #28a745;
            color: white;
            border: none;
            margin-top: 15px;
        }

        #btn-cek-stok-obat:hover {
            background-color: #218838;
        }
        /* Menghilangkan background dan padding pada judul SweetAlert */
        .swal-no-title-bg {
            background: none !important; /* Menghapus background */
            padding: 0 !important; /* Menghapus padding */
        }
        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }

            h2 {
                font-size: 24px;
            }

            .form-control {
                font-size: 14px;
            }

            .btn {
                font-size: 14px;
            }
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
                    <a class="nav-link" href="{{ route('dashboardutama') }}">Dasboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container mt-5">
    <h2>Cek Obat Keras</h2>

    <!-- Form Input Obat -->
    <form id="formCekObat" action="/cekobatkeras/proses" method="POST">
        <!-- Token CSRF -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- Input hidden untuk mengirimkan id_pembelian -->
        <input type="hidden" name="id_pembelian" value="{{ $idPembelian }}">

        <div id="obat-container">
            <!-- Satu kotak input obat -->
            <div class="form-group obat-entry mb-3">
                <label for="nama_obat_0">Nama Obat 1</label>
                <input type="text" id="nama_obat_0" name="nama_obat[]" class="form-control nama-obat" placeholder="Masukkan nama obat">
                <button type="button" class="btn btn-primary mt-2 cek-obat-btn" data-input-id="nama_obat_0">Cek Obat Keras</button>
                
                <div class="validasi-container mt-2" style="display: none;">
                    <p>Obat ini termasuk kategori <strong>Obat Keras</strong>. Harap lanjut ke validasi dokter.</p>
                    <input type="checkbox" class="validasi-dokter-checkbox" data-input-id="nama_obat_0"> Centang untuk validasi dokter
                    <a href="/validasidokter/{{ $idPembelian }}" class="btn btn-warning mt-2">Validasi Resep ke Dokter</a>
                </div>
                
                <div class="non-obat-keras mt-2" style="display: none;">
                    <p>Obat ini tidak termasuk kategori <strong>Obat Keras</strong>.</p>
                </div>
            </div>
        </div>

        <!-- Tombol untuk menambah input obat -->
        <button type="button" id="btn-tambah-obat" class="btn btn-info mt-3">Tambah Obat</button>

        <!-- Tombol untuk melanjutkan ke halaman cek stok obat -->
        <button type="button" id="btn-cek-stok-obat" class="btn btn-success mt-3" style="display: none;">Cek Stok Obat</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Array untuk menyimpan daftar obat dari database
    let daftarObat = {!! json_encode($daftarObat) !!}; // Mengambil daftar obat dari controller
    let obatKeras = {!! json_encode($obatKeras) !!};  // Mengambil daftar obat keras dari controller
    let hasObatKeras = false; // Menandai apakah ada obat keras atau tidak
    let idPembelian = "{{ $idPembelian }}"; // Mendapatkan id pembelian dari blade
    let counter = 1; // Menambahkan counter untuk input obat

    // Implementasi autocomplete untuk semua input obat
    function applyAutocomplete(input) {
        $(input).autocomplete({
            source: daftarObat
        });
    }

    $(".nama-obat").each(function() {
        applyAutocomplete(this);
    });

    // Event untuk tombol cek obat keras
    $(document).on('click', '.cek-obat-btn', function() {
        // Mendapatkan ID input yang terkait dengan tombol ini
        let inputId = $(this).data("input-id");
        let obatTerpilih = $("#" + inputId).val().trim();

        // Periksa jika input tidak kosong
        if (obatTerpilih === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Silakan masukkan nama obat terlebih dahulu.',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal-no-padding',
                    title: 'swal-no-title-bg' // Kelas khusus untuk mengubah gaya judul
                },
                confirmButtonColor: '#204ae6' // Warna tombol OK sesuai dengan tema biru
            });
            return;
        }

        // Memeriksa apakah obat ini adalah obat keras
        let isObatKeras = obatKeras.includes(obatTerpilih);

        if (isObatKeras) {
            // Menandai bahwa ada obat keras
            hasObatKeras = true;
            // Menampilkan kontainer validasi jika obat adalah obat keras
            $(this).siblings('.validasi-container').show();
            $(this).siblings('.non-obat-keras').hide(); // Sembunyikan pesan non-obat keras
        } else {
            // Menampilkan pesan jika obat bukan obat keras
            $(this).siblings('.validasi-container').hide(); // Sembunyikan pesan obat keras
            $(this).siblings('.non-obat-keras').show(); // Tampilkan pesan non-obat keras
        }

        // Tampilkan tombol "Cek Stok Obat"
        $("#btn-cek-stok-obat").show();

        // Periksa validasi untuk menentukan apakah tombol cek stok obat dapat digunakan
        updateCekStokObatButton();
    });

    // Event untuk kotak centang validasi dokter
    $(document).on('change', '.validasi-dokter-checkbox', function() {
        // Periksa validasi untuk menentukan apakah tombol cek stok obat dapat digunakan
        updateCekStokObatButton();
    });

    // Event untuk tombol "Cek Stok Obat"
    $("#btn-cek-stok-obat").on('click', function() {
        // Mengarahkan ke halaman cek stok obat dengan id_pembelian sebagai query parameter
        window.location.href = "/cekstokobat?id_pembelian=" + idPembelian;
    });

    function updateCekStokObatButton() {
        // Jika ada obat keras, periksa apakah semua kotak centang sudah dicentang
        if (hasObatKeras) {
            let semuaCentang = true;
            $(".validasi-dokter-checkbox:visible").each(function() {
                if (!$(this).is(":checked")) {
                    semuaCentang = false;
                    return false; // Break loop jika ada yang belum dicentang
                }
            });

            // Aktifkan atau nonaktifkan tombol "Cek Stok Obat" berdasarkan validasi
            $("#btn-cek-stok-obat").prop('disabled', !semuaCentang);
        } else {
            // Jika tidak ada obat keras, tombol "Cek Stok Obat" diaktifkan
            $("#btn-cek-stok-obat").prop('disabled', false);
        }
    }

    // Event untuk tombol "Tambah Obat"
    $("#btn-tambah-obat").on('click', function() {
        // Increment counter for unique IDs
        let obatEntryHtml = `
            <div class="form-group obat-entry mb-3">
                <label for="nama_obat_${counter}">Nama Obat ${counter + 1}</label>
                <input type="text" id="nama_obat_${counter}" name="nama_obat[]" class="form-control nama-obat" placeholder="Masukkan nama obat">
                <button type="button" class="btn btn-primary mt-2 cek-obat-btn" data-input-id="nama_obat_${counter}">Cek Obat Keras</button>
                
                <div class="validasi-container mt-2" style="display: none;">
                    <p>Obat ini termasuk kategori <strong>Obat Keras</strong>. Harap lanjut ke validasi dokter.</p>
                    <input type="checkbox" class="validasi-dokter-checkbox" data-input-id="nama_obat_${counter}"> Centang untuk validasi dokter
                    <a href="/validasidokter/{{ $idPembelian }}" class="btn btn-warning mt-2">Validasi Resep ke Dokter</a>
                </div>
                
                <div class="non-obat-keras mt-2" style="display: none;">
                    <p>Obat ini tidak termasuk kategori <strong>Obat Keras</strong>.</p>
                </div>
            </div>`;

        // Append the new input entry to the container
        $("#obat-container").append(obatEntryHtml);
        // Apply autocomplete to the new input
        applyAutocomplete(`#nama_obat_${counter}`);

        // Increment counter for the next input
        counter++;
    });
});
</script>

</body>
</html>
