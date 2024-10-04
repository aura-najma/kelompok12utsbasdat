<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Stok Obat</title>
    <style>
        /* Tambahkan style khusus untuk stok rendah */
        .low-stock {
            background-color: #f8d7da; /* Warna merah muda untuk menandai stok rendah */
        }
    </style>
</head>
<body>
    <h1>Daftar Obat</h1>

    <!-- Tampilkan pesan sukses atau error (jika ada) -->
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <!-- Cek apakah ada obat yang ditemukan -->
    @if($obatList->isNotEmpty())
        <table border="1">
            <thead>
                <tr>
                    <th>No BPOM</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Jenis Obat</th>
                    <th>Stok</th>
                    <th>Tanggal Kadaluwarsa</th>
                    <th>Harga Satuan</th>
                    <th>Kategori Obat Keras</th>
                    <th>Dosis</th>
                    <th>Aturan Pakai</th>
                    <th>Rute Obat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping melalui setiap obat dalam data yang dikirim -->
                @foreach($obatList as $obat)
                <!-- Tambahkan kelas `low-stock` jika stok kurang dari 5 -->
                <tr @if($obat->stok < 5) class="low-stock" @endif>
                    <td>{{ $obat->no_bpom }}</td>
                    <td>{{ $obat->nama }}</td>
                    <td>{{ $obat->kategori }}</td>
                    <td>{{ $obat->jenis_obat }}</td>
                    <td>{{ $obat->stok }}</td>
                    <td>{{ $obat->tanggal_kadaluwarsa }}</td>
                    <td>{{ $obat->harga_satuan }}</td>
                    <td>{{ $obat->kategori_obat_keras }}</td>
                    <td>{{ $obat->dosis }}</td>
                    <td>{{ $obat->aturan_pakai }}</td>
                    <td>{{ $obat->rute_obat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada obat yang tersedia saat ini.</p>
    @endif

    <!-- Tombol untuk menuju halaman tambah stok -->
    <div style="margin-top: 20px;">
        <a href="{{ url('/lihatstokobat/tambah-stok') }}">
            <button type="button">Tambah Stok Obat</button>
        </a>
    </div>

    <!-- Tombol untuk menuju halaman tambah obat baru -->
    <div style="margin-top: 20px;">
        <a href="{{ url('/lihatstokobat/tambah-obat') }}">
            <button type="button">Tambah Obat Baru</button>
        </a>
    </div>
</body>
</html>
