<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Obat</title>
</head>
<body>
    <h1>Tambah Stok Obat</h1>

    <!-- Form untuk menambah stok obat -->
    <form action="{{ url('/lihatstokobat/tambah-stok') }}" method="POST">
        @csrf <!-- Token CSRF untuk keamanan -->

        <div>
            <label for="no_bpom">No BPOM:</label>
            <input type="text" id="no_bpom" name="no_bpom" required>
        </div>

        <div>
            <label for="stok">Jumlah Stok yang Ditambahkan:</label>
            <input type="number" id="stok" name="stok" min="1" required>
        </div>

        <button type="submit">Tambah Stok</button>
    </form>

    <!-- Tampilkan pesan sukses atau error (jika ada) -->
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>
