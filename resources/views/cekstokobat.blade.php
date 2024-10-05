<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Obat</title>
    <style>
        /* Tambahkan style tambahan di sini jika diperlukan */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            cursor: pointer;
        }

        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Cek Stok Obat</h1>

    <!-- Menampilkan ID Pembelian -->
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_pembelian" value="{{ $idPembelian }}"> <!-- Pastikan ini ada -->

        
        @if($obatList->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>No BPOM</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obatList as $obat)
                    <tr>
                        <td>{{ $obat->no_bpom }}</td>
                        <td>{{ $obat->nama }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td>{{ $obat->harga_satuan }}</td>
                        <td>
                            <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', false)">-</button>
                            <input type="number" id="qty-{{ $obat->no_bpom }}" name="obats[{{ $obat->no_bpom }}][jumlah]" value="0" min="0" oninput="checkQuantity()">
                            <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', true)">+</button>

                            <input type="hidden" name="obats[{{ $obat->no_bpom }}][harga_satuan]" value="{{ $obat->harga_satuan }}">
                            <input type="hidden" name="obats[{{ $obat->no_bpom }}][nama]" value="{{ $obat->nama }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit">Beli Obat</button>
        @else
            <p>Tidak ada obat yang tersedia saat ini.</p>
        @endif
    </form>

    <script>
        // Fungsi untuk menambah atau mengurangi jumlah obat yang ingin dibeli
        function changeQuantity(obatId, increment) {
            let qtyInput = document.getElementById('qty-' + obatId);
            let currentQty = parseInt(qtyInput.value);
            
            if (increment) {
                qtyInput.value = currentQty + 1;
            } else {
                if (currentQty > 0) qtyInput.value = currentQty - 1;
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
