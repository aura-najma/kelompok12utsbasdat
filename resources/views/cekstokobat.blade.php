<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }


        h1 {
            background: #fff; /* White background */
            padding: 10px; 
            font-size: 50px; 
            font-weight: 600; 
            text-align: center; 
            border-radius: 15px; 
            margin-bottom: 20px;
            margin-top: 30px;
            background-clip: text; /* Ensures gradient applies to text */
            -webkit-background-clip: text; /* For Safari */
            color: transparent; /* Hides the background color of the text */
            background-image: linear-gradient(-135deg, #204ae6, #36bef8); /* Gradient for text */
        }


        table {
            width: 98%; /* Set the width of the table */
            border-collapse: collapse; /* Collapse borders */
            margin: 0 auto 20px; /* Center the table and add bottom margin */
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
            justify-content: center; /* Center the button horizontally */
            margin-top: 20px; /* Optional: Adds some space above the button */
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
            background: linear-gradient(-180deg,  #204ae6,#36bef8);
        }
        .navbar-brand img {
            width: 200px;
            height: auto;
        }
        .navbar-nav .nav-link {
            color: white;
            font-weight: 600;
            margin-right:30px;
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <h1>Cek Stok Obat</h1>

        <!-- Menampilkan ID Pembelian -->
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_pembelian" value="{{ $idPembelian }}">

            @if($obatList->isNotEmpty())
                <table>
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
                
                <div class="btn-container">
                    <button id="purchase-button" type="submit" class="btn-custom disabled" disabled>Beli Obat</button>
                </div>

            @else
                <p>Tidak ada obat yang tersedia saat ini.</p>
            @endif
        </form>
    

    <script>
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
