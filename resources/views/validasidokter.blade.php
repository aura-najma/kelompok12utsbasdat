<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <title>Validasi Dokter</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
        }
        .table-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: auto;
        }
        .text-custom {
            color: #2295B4;
        }
        .btn-whatsapp {
            background-color: #a4c757;
            color: white;
        }
        .btn-whatsapp:hover {
            background-color: #8fb54b;
        }
        .pagination .page-link {
            background-color: #a4c757;
            color: white;
        }
        .pagination .page-link:hover {
            background-color: #8fb54b;
            color: white;
        }
        .pagination .page-item.active .page-link {
            background-color: #8fb54b;
            border-color: #8fb54b;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-container">
            <h3 class="text-custom text-center mb-4">Validasi Dokter</h3>
            <table id="doctorTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Dokter</th>
                        <th>Nomor STR</th>
                        <th>Spesialisasi</th>
                        <th>Alamat</th>
                        <th>Hubungi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Andi Saputra</td>
                        <td>AS12345678901234</td>
                        <td>Spesialis Anak</td>
                        <td>Jl. Kenanga No. 23, Surabaya</td>
                        <td><a href="https://wa.me/628123456789" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Fitri Ayu</td>
                        <td>FA98765432101234</td>
                        <td>Spesialis Kandungan</td>
                        <td>Jl. Mangga No. 15, Sidoarjo</td>
                        <td><a href="https://wa.me/628987654321" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Bambang Yudistira</td>
                        <td>BY56789012341234</td>
                        <td>Spesialis Jantung</td>
                        <td>Jl. Mawar No. 7, Gresik</td>
                        <td><a href="https://wa.me/628567890123" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Citra Lestari</td>
                        <td>CL34567890123456</td>
                        <td>Spesialis Bedah</td>
                        <td>Jl. Kamboja No. 2, Surabaya</td>
                        <td><a href="https://wa.me/628345678901" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Dedi Firmansyah</td>
                        <td>DF45678901234567</td>
                        <td>Spesialis Saraf</td>
                        <td>Jl. Cendana No. 10, Malang</td>
                        <td><a href="https://wa.me/628456789012" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Evi Susanti</td>
                        <td>ES23456789012345</td>
                        <td>Spesialis Mata</td>
                        <td>Jl. Melati No. 12, Surabaya</td>
                        <td><a href="https://wa.me/628234567890" class="btn btn-whatsapp" target="_blank">WhatsApp</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#doctorTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "pageLength": 5
            });
        });
    </script>
</body>
</html>
