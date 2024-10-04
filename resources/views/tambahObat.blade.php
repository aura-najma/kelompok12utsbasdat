<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Obat Baru</title>
</head>
<body>
    <h1>Tambah Obat Baru</h1>

    <!-- Form untuk menambah obat baru -->
    <form action="{{ url('/lihatstokobat/tambah-obat') }}" method="POST">
        @csrf <!-- Token CSRF untuk keamanan -->

        <div>
            <label for="no_bpom">No BPOM:</label>
            <input type="text" id="no_bpom" name="no_bpom" required>
        </div>

        <div>
            <label for="nama">Nama Obat:</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div>
            <label for="kategori">Kategori:</label>
            <input type="text" id="kategori" name="kategori" required>
        </div>

        <div>
            <label for="jenis_obat">Jenis Obat:</label>
            <input type="text" id="jenis_obat" name="jenis_obat" required>
        </div>

        <div>
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" min="1" required>
        </div>

        <div>
            <label for="tanggal_kadaluwarsa">Tanggal Kadaluwarsa:</label>
            <input type="date" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" required>
        </div>

        <div>
            <label for="harga_satuan">Harga Satuan:</label>
            <input type="number" id="harga_satuan" name="harga_satuan" min="1" required>
        </div>

        <div>
            <label for="kategori_obat_keras">Kategori Obat Keras:</label>
            <input type="text" id="kategori_obat_keras" name="kategori_obat_keras">
        </div>

        <div>
            <label for="dosis">Dosis:</label>
            <textarea id="dosis" name="dosis" required></textarea>
        </div>

        <div>
            <label for="aturan_pakai">Aturan Pakai:</label>
            <textarea id="aturan_pakai" name="aturan_pakai" required></textarea>
        </div>

        <div>
            <label for="rute_obat">Rute Obat:</label>
            <input type="text" id="rute_obat" name="rute_obat" required>
        </div>

        <button type="submit">Tambah Obat</button>
    </form>

    <!-- Tampilkan pesan sukses atau error (jika ada) -->
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>
