<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Obat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom theme color */
        body {
            background-color: #f1f9fb; /* Light blue background for contrast */
        }
        
        h1 {
            color: #2295b4;
        }

        /* Customizing the table */
        .table {
            background-color: #e9f6f9; /* Light blueish background for the table */
            border-color: #2295b4; /* Border in theme color */
        }

        .table th {
            background-color: #2295b4;
            color: white;
        }

        .table td {
            background-color: #f1f9fb;
            border-color: #2295b4; /* Border color for table cells */
        }

        .btn-primary {
            background-color: #2295b4;
            border-color: #2295b4;
        }

        .btn-primary:hover {
            background-color: #1b7b90;
            border-color: #1b7b90;
        }

        .btn-secondary {
            background-color: #2295b4;
            border-color: #2295b4;
        }

        .btn-secondary:hover {
            background-color: #1b7b90;
            border-color: #1b7b90;
        }

        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Centered Title -->
        <h1 class="text-center">Daftar Obat</h1>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Jenis Obat</th>
                    <th>Stok</th>
                    <th>Tanggal Produksi</th>
                    <th>Tanggal Kadaluwarsa</th>
                    <th>Harga Satuan</th>
                    <th>Kategori Obat Keras</th>
                    <th>Dosis</th>
                    <th>Aturan Pakai</th>
                    <th>Rute Obat</th>
                    <th>ID Obat (No BPOM)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Paracetamol</td>
                    <td>Demam</td>
                    <td>Bebas</td>
                    <td>10</td>
                    <td>2023-01-01</td>
                    <td>2025-01-01</td>
                    <td>Rp 5.000</td>
                    <td>-</td>
                    <td>500 mg</td>
                    <td>3x sehari</td>
                    <td>Oral</td>
                    <td>BPOM 123456789</td>
                    <td>
                        <button class="btn btn-secondary btn-sm" onclick="decreaseCount(0)">-</button>
                        <input type="text" id="quantity0" value="0" size="1" style="text-align: center;">
                        <button class="btn btn-secondary btn-sm" onclick="increaseCount(0)">+</button>
                    </td>
                </tr>
                <tr>
                    <td>Bisoprolol</td>
                    <td>Darah Tinggi</td>
                    <td>Keras</td>
                    <td>5</td>
                    <td>2022-05-01</td>
                    <td>2024-05-01</td>
                    <td>Rp 15.000</td>
                    <td>A</td>
                    <td>5 mg</td>
                    <td>1x sehari</td>
                    <td>Oral</td>
                    <td>BPOM 987654321</td>
                    <td>
                        <button class="btn btn-secondary btn-sm" onclick="decreaseCount(1)">-</button>
                        <input type="text" id="quantity1" value="0" size="1" style="text-align: center;">
                        <button class="btn btn-secondary btn-sm" onclick="increaseCount(1)">+</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Centered Checkout Button -->
        <div class="text-center">
            <button class="btn btn-primary">Checkout</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Counter -->
    <script>
        function increaseCount(index) {
            let quantity = document.getElementById('quantity' + index);
            quantity.value = parseInt(quantity.value) + 1;
        }

        function decreaseCount(index) {
            let quantity = document.getElementById('quantity' + index);
            if (parseInt(quantity.value) > 0) {
                quantity.value = parseInt(quantity.value) - 1;
            }
        }
    </script>
</body>
</html>
