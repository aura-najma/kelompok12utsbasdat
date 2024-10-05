<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokter</title>
</head>
<body>
    <h1>Daftar Dokter</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Dokter</th>
                <th>Nomor STR</th>
                <th>Spesialisasi</th>
                <th>Alamat</th>
                <th>Hubungi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokter as $dokter)
                <tr>
                    <td>{{ $dokter->id }}</td>
                    <td>{{ $dokter->nama_dokter }}</td>
                    <td>{{ $dokter->nomor_str }}</td>
                    <td>{{ $dokter->spesialisasi }}</td>
                    <td>{{ $dokter->alamat }}</td>
                    <td>{{ $dokter->hubungi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
