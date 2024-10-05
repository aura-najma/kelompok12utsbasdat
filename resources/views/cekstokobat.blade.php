<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Obat</title>
    <style>
        .quantity-control {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-control button {
            width: 30px;
            height: 30px;
            text-align: center;
            cursor: pointer;
        }

        .quantity-control input {
            width: 50px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .checkout-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Daftar Stok Obat</h1>

    <!-- Form untuk checkout -->
    <form action="{{ route('checkoutobat') }}" method="POST">
        @csrf

        <!-- Cek apakah ada obat yang ditemukan -->
        @if($obatList->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>No BPOM</th>
                        <th>Nama Obat</th>
                        <th>Stok</th>
                        <th>Harga Satuan</th>
                        <th>Beli</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping melalui setiap obat dalam data yang dikirim -->
                    @foreach($obatList as $obat)
                    <tr>
                        <td>{{ $obat->no_bpom }}</td>
                        <td>{{ $obat->nama }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td>{{ number_format($obat->harga_satuan, 0, ',', '.') }}</td>
                        <td>
                            <!-- Form untuk memilih jumlah obat yang ingin dibeli -->
                            <div class="quantity-control">
                                <button type="button" onclick="decreaseQuantity('{{ $obat->id }}')">-</button>
                                <input type="number" name="quantities[{{ $obat->id }}]" id="quantity-{{ $obat->id }}" value="0" min="0">
                                <button type="button" onclick="increaseQuantity('{{ $obat->id }}')">+</button>
                            </div>
                            <!-- Hidden fields untuk informasi obat -->
                            <input type="hidden" name="names[{{ $obat->id }}]" value="{{ $obat->nama }}">
                            <input type="hidden" name="prices[{{ $obat->id }}]" value="{{ $obat->harga_satuan }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada obat yang tersedia saat ini.</p>
        @endif

        <!-- Tombol untuk Checkout -->
        <button type="submit" class="checkout-button">Checkout Obat</button>
    </form>

    <script>
        function increaseQuantity(obatId) {
            const quantityInput = document.getElementById('quantity-' + obatId);
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity(obatId) {
            const quantityInput = document.getElementById('quantity-' + obatId);
            if (quantityInput.value > 0) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
</body>
</html>
