<!DOCTYPE html>
<html>
<head>
    <title>Validasi Dokter</title>
</head>
<body>
    <h1>Daftar Dokter</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Dokter</th>
            <th>Nomor STR</th>
            <th>Spesialisasi</th>
            <th>Alamat</th>
            <th>Hubungi</th>
        </tr>
        @foreach($dokters as $dokter)
        <tr>
            <td>{{ $dokter->id }}</td>
            <td>{{ $dokter->nama_dokter }}</td>
            <td>{{ $dokter->nomor_str }}</td>
            <td>{{ $dokter->spesialisasi }}</td>
            <td>{{ $dokter->alamat }}</td>
            <td>{{ $dokter->hubungi }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
