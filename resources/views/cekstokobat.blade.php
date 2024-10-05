<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Obat</title>
    <style>
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
                            <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', false)">-</button>
                            <input type="number" id="qty-{{ $obat->no_bpom }}" name="obats[{{ $obat->no_bpom }}][jumlah]" value="0" min="0" oninput="checkQuantity()">
                            <button type="button" onclick="changeQuantity('{{ $obat->no_bpom }}', true)">+</button>

                            <!-- Data yang akan dikirim ke transaksi -->
                            <input type="hidden" name="obats[{{ $obat->no_bpom }}][harga_satuan]" value="{{ $obat->harga_satuan }}">
                            <input type="hidden" name="obats[{{ $obat->no_bpom }}][nama]" value="{{ $obat->nama }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button id="purchase-button" type="submit" class="disabled" disabled>Beli Obat</button>
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
