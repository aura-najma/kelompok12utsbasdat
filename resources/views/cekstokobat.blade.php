<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cek Stok Obat</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
        }
        .container {
            max-width: 1200px; /* Increase width */
            margin-top: 5rem;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .text-custom {
            color: #2295B4;
        }
        .input-group {
            width: 150px; /* Fixed width for input group */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-custom">Cek Stok Obat</h3>
        <input type="text" id="search" class="form-control mb-3" placeholder="Cari obat...">

        <table class="table table-bordered" id="medicationTable">
            <thead>
                <tr>
                    <th>No BPOM</th>
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
                    <th>Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DKL 1908026138A1</td>
                    <td>Paracetamol</td>
                    <td>Obat Bebas</td>
                    <td>Bebas</td>
                    <td class="stock">100</td>
                    <td>2022-01-01</td>
                    <td>2024-01-01</td>
                    <td>2000</td>
                    <td>-</td>
                    <td>500 mg</td>
                    <td>Setelah makan</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A2</td>
                    <td>Amoxicillin</td>
                    <td>Obat Keras</td>
                    <td>Keras</td>
                    <td class="stock">50</td>
                    <td>2022-02-01</td>
                    <td>2024-02-01</td>
                    <td>5000</td>
                    <td>B</td>
                    <td>250 mg</td>
                    <td>Saat sakit</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A3</td>
                    <td>Ibuprofen</td>
                    <td>Obat Bebas</td>
                    <td>Bebas</td>
                    <td class="stock">200</td>
                    <td>2022-03-01</td>
                    <td>2024-03-01</td>
                    <td>3000</td>
                    <td>-</td>
                    <td>400 mg</td>
                    <td>Setiap 8 jam</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A4</td>
                    <td>Salbutamol</td>
                    <td>Obat Keras</td>
                    <td>Keras</td>
                    <td class="stock">30</td>
                    <td>2022-04-01</td>
                    <td>2024-04-01</td>
                    <td>7000</td>
                    <td>A</td>
                    <td>100 mcg</td>
                    <td>Jika perlu</td>
                    <td>Inhalasi</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A5</td>
                    <td>Coltin Dry Sirup</td>
                    <td>Obat Keras</td>
                    <td>Keras</td>
                    <td class="stock">25</td>
                    <td>2022-05-01</td>
                    <td>2024-05-01</td>
                    <td>6000</td>
                    <td>C</td>
                    <td>5 ml</td>
                    <td>Sebelum makan</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A6</td>
                    <td>Metformin</td>
                    <td>Obat Keras</td>
                    <td>Keras</td>
                    <td class="stock">60</td>
                    <td>2022-06-01</td>
                    <td>2024-06-01</td>
                    <td>4000</td>
                    <td>D</td>
                    <td>500 mg</td>
                    <td>Setiap hari</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DKL 1908026138A7</td>
                    <td>Loperamide</td>
                    <td>Obat Bebas</td>
                    <td>Bebas</td>
                    <td class="stock">150</td>
                    <td>2022-07-01</td>
                    <td>2024-07-01</td>
                    <td>2500</td>
                    <td>-</td>
                    <td>2 mg</td>
                    <td>Setelah makan</td>
                    <td>Oral</td>
                    <td>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" class="form-control quantity" value="0" min="0" max="3" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Sebelumnya</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
            </ul>
        </nav>

        <div class="text-center">
            <button type="button" class="btn btn-success" onclick="window.location.href='checkoutobat'">Checkout</button>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#medicationTable tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
            });
        });

        function changeQuantity(button, delta) {
            const input = button.parentElement.querySelector('input[type="number"]');
            const stockCell = button.closest('tr').querySelector('.stock');
            let currentValue = parseInt(input.value);
            const maxValue = 3; // Max purchase quantity
            const maxStock = parseInt(stockCell.textContent); // Get current stock from the row

            if (delta === 1 && currentValue < maxValue && maxStock > 0) {
                input.value = currentValue + 1; // Increase quantity
                stockCell.textContent = maxStock - 1; // Decrease stock
            } else if (delta === -1 && currentValue > 0) {
                input.value = currentValue - 1; // Decrease quantity
                stockCell.textContent = maxStock + 1; // Increase stock
            }
        }
    </script>
</body>
</html>
