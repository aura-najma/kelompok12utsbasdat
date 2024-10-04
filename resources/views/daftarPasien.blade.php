<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien</title>
</head>
<body>
    <h1>Daftar Pasien</h1>

    <!-- Cek apakah ada pasien yang ditemukan -->
    @if($pasienList->isNotEmpty())
        <table border="1">
            <thead>
                <tr>
                    <th>No Telepon</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Alergi Obat</th>
                    <th>Pembelian Pertama Kali</th> <!-- Kolom untuk tanggal pembuatan data -->
                </tr>
            </thead>
            <tbody>
                <!-- Looping melalui setiap pasien dalam data yang dikirim -->
                @foreach($pasienList as $pasien)
                <tr>
                    <td>{{ $pasien->no_telepon }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->alergi_obat }}</td>
                    <td>{{ $pasien->created_at }}</td> <!-- Menampilkan tanggal pembuatan data -->
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada pasien yang tersedia saat ini.</p>
    @endif
</body>
</html>
