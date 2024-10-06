<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Obat Keras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

<div class="container mt-5">
    <h2>Cek Obat Keras</h2>

    <!-- Form Input Obat -->
    <form id="formCekObat" action="/cekobatkeras/proses" method="POST">
        <!-- Token CSRF -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- Input hidden untuk mengirimkan id_pembelian -->
        <input type="hidden" name="id_pembelian" value="{{ $idPembelian }}">

        <div id="obat-container">
            <!-- Mengulang input obat untuk empat kali -->
            @for ($i = 0; $i < 4; $i++)
                <div class="form-group obat-entry mb-3">
                    <label for="nama_obat_{{ $i }}">Nama Obat {{ $i + 1 }}</label>
                    <input type="text" id="nama_obat_{{ $i }}" name="nama_obat[]" class="form-control nama-obat" placeholder="Masukkan nama obat">
                    <button type="button" class="btn btn-primary mt-2 cek-obat-btn" data-input-id="nama_obat_{{ $i }}">Cek Obat Keras</button>
                    <div class="validasi-container mt-2" style="display: none;">
                        <p>Obat ini termasuk kategori <strong>Obat Keras</strong>. Harap lanjut ke validasi dokter.</p>
                        <input type="checkbox" class="validasi-dokter-checkbox" data-input-id="nama_obat_{{ $i }}"> Centang untuk validasi dokter
                        <a href="/validasidokter/{{ $idPembelian }}" class="btn btn-warning mt-2">Validasi Resep ke Dokter</a>
                    </div>
                    <div class="non-obat-keras mt-2" style="display: none;">
                        <p>Obat ini tidak termasuk kategori <strong>Obat Keras</strong>.</p>
                    </div>
                </div>
            @endfor
        </div>

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

    // Implementasi autocomplete untuk semua input obat
    $(".nama-obat").each(function() {
        $(this).autocomplete({
            source: daftarObat
        });
    });

    // Event untuk tombol cek obat keras
    $(".cek-obat-btn").on('click', function() {
        // Mendapatkan ID input yang terkait dengan tombol ini
        let inputId = $(this).data("input-id");
        let obatTerpilih = $("#" + inputId).val().trim();

        // Periksa jika input tidak kosong
        if (obatTerpilih === "") {
            alert("Silakan masukkan nama obat terlebih dahulu.");
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
    $(".validasi-dokter-checkbox").on('change', function() {
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
            if (semuaCentang) {
                $("#btn-cek-stok-obat").prop('disabled', false);
            } else {
                $("#btn-cek-stok-obat").prop('disabled', true);
            }
        } else {
            // Jika tidak ada obat keras, tombol "Cek Stok Obat" diaktifkan
            $("#btn-cek-stok-obat").prop('disabled', false);
        }
    }
});
</script>

</body>
</html>
