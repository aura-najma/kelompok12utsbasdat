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
                        <a href="/validasidokter/{{ $idPembelian }}" class="btn btn-warning">Lanjut Validasi Dokter</a>
                    </div>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success">Submit Semua Obat</button>
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
            // Menampilkan kontainer validasi jika obat adalah obat keras
            $(this).siblings('.validasi-container').show();
        } else {
            // Menyembunyikan kontainer validasi jika obat bukan obat keras
            $(this).siblings('.validasi-container').hide();
            alert("Obat ini tidak termasuk kategori Obat Keras.");
        }
    });
});
</script>

</body>
</html>
