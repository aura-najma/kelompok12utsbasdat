<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        h1 {
            padding: 10px;
            font-size: 50px;
            font-weight: 600;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 20px;
            margin-top: 30px;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(-135deg, #204ae6, #36bef8);
        }

        table {
            width: 98%;
            border-collapse: collapse;
            margin: 0 auto 20px;
        }

        td {
            border: 1px solid #36bef8;
            padding: 10px;
            text-align: left;
            background: rgba(255, 255, 255, 0.8);
        }

        th {
            border: 1px solid #fff;
            padding: 10px;
            background: linear-gradient(-180deg, #204ae6, #36bef8);
            text-align: center;
            color: white;
        }

        button {
            cursor: pointer;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .btn-custom {
            color: white;
            width: 10%;
            padding: 10px;
            border-radius: 15px;
            background: linear-gradient(-135deg, #204ae6, #36bef8);
            font-weight: 600;
            border: none;
            margin-top: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        input[type="number"] {
            width: 60px;
            text-align: center;
        }

        .navbar {
            background: linear-gradient(-180deg, #204ae6, #36bef8);
        }

        .navbar-brand img {
            width: 200px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right: 30px;
        }

        .alert {
            width: 90%;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo di kiri -->
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo2.png" alt="Logo">
            </a>

            <!-- Tombol Home di kanan -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboardutama') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Cek Stok Obat</h1>

    <!-- Menampilkan ID Pembelian -->
    <form action="{{ route('transaksi.store') }}" method="POST" onsubmit="return confirmAlergiObat()">
        @csrf
        <input type="hidden" name="id_pembelian" value="{{ $idPembelian }}">

        @if($obatList->isNotEmpty())
            <div class="table-responsive">
                <table id="obatTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No BPOM</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jenis Obat</th>
                            <th>Stok</th>
                            <th>Tanggal Kadaluwarsa</th>
                            <th>Harga Satuan</th>
                            <th>Kategori Obat Keras</th>
                            <th>Dosis</th>
                            <th>Aturan Pakai</th>
                            <th>Rute Obat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($obatList as $obat)
                        <tr>
                            <td>{{ $obat->no_bpom }}</td>
                            <td>{{ $obat->nama }}</td>
                            <td>{{ $obat->kategori }}</td>
                            <td>{{ $obat->jenis_obat }}</td>
                            <td id="stok-{{ $obat->no_bpom }}">{{ $obat->stok }}</td>
                            <td>{{ $obat->tanggal_kadaluwarsa }}</td>
                            <td>{{ $obat->harga_satuan }}</td>
                            <td>{{ $obat->kategori_obat_keras }}</td>
                            <td>{{ $obat->dosis }}</td>
                            <td>{{ $obat->aturan_pakai }}</td>
                            <td>{{ $obat->rute_obat }}</td>
                            <td>
                                <div class="quantity-control">
                                    <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', false)">-</button>
                                    <input type="number" id="qty-{{ $obat->no_bpom }}" name="obats[{{ $obat->no_bpom }}][jumlah]" value="0" min="0" oninput="checkQuantity()">
                                    <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', true)">+</button>
                                </div>

                                <!-- Data yang akan dikirim ke transaksi -->
                                <input type="hidden" name="obats[{{ $obat->no_bpom }}][harga_satuan]" value="{{ $obat->harga_satuan }}">
                                <input type="hidden" name="obats[{{ $obat->no_bpom }}][nama]" value="{{ $obat->nama }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="btn-container">
                <button id="purchase-button" type="submit" class="btn-custom disabled" disabled>Beli Obat</button>
            </div>

        @else
            <p class="text-center">Tidak ada obat yang tersedia saat ini.</p>
        @endif
    </form>

    <!-- Script Section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
       $(document).ready(function() {
            $('#obatTable').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": true, // Hanya menggunakan fitur search
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json"
                }
            });
        });

        // Fungsi untuk menambah atau mengurangi jumlah obat yang ingin dibeli
        function changeQuantity(obatId, increment) {
            let qtyInput = document.getElementById('qty-' + obatId);
            let stokElement = document.getElementById('stok-' + obatId);
            let currentQty = parseInt(qtyInput.value);
            let currentStok = parseInt(stokElement.innerText);

            if (increment && currentQty < currentStok) {
                qtyInput.value = currentQty + 1;
                stokElement.innerText = currentStok - 1;
            } else if (!increment && currentQty > 0) {
                qtyInput.value = currentQty - 1;
                stokElement.innerText = currentStok + 1;
            }

            checkQuantity();
        }

        // Fungsi untuk memeriksa jumlah obat dan mengaktifkan tombol beli
        function checkQuantity() {
            const inputs = document.querySelectorAll('input[type="number"]');
            let enableButton = false;

            inputs.forEach(input => {
                if (parseInt(input.value) > 0) {
                    enableButton = true;
                }
            });

            const purchaseButton = document.getElementById('purchase-button');
            if (enableButton) {
                purchaseButton.classList.remove('disabled');
                purchaseButton.disabled = false;
            } else {
                purchaseButton.classList.add('disabled');
                purchaseButton.disabled = true;
            }
        }
    </script>
</body>
</html>
