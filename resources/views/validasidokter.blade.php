<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Daftar Dokter</h2>
    
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if ($dokters->isEmpty())
        <p>Tidak ada data dokter yang tersedia.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor STR</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Alamat</th>
                    <th>Hubungi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokters as $dokter)
                    <tr>
                        <td>{{ $dokter->nomor_str }}</td>
                        <td>{{ $dokter->nama_dokter }}</td>
                        <td>{{ $dokter->spesialisasi }}</td>
                        <td>{{ $dokter->alamat }}</td>
                        <td>
                            @if($dokter->hubungi)
                                <a href="{{ $dokter->hubungi }}" class="btn btn-success" target="_blank">Hubungi via WhatsApp</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
