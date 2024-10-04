<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Invoice Transaksi</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 2rem;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .text-custom {
            color: #2295B4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 class="text-custom">APOTEK DAWAI</h2>
            <p>Alamat: Jl. Kesehatan No. 123, Surabaya</p>
            <p>No Telp: 081234567890</p>
        </div>
        <h5>ID Transaksi: <span id="transactionId">TRX123456</span></h5>
        <h5>Nama Pembeli: <span id="buyerName">Putri Ayudia</span></h5>
        <h5>No Telepon: <span id="buyerPhone">08133448580384</span></h5>
        <h5>Tanggal dan Jam Transaksi: <span id="transactionDate">2024-09-22 14:30</span></h5>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
                    <th>Total Harga (Rp)</th>
                </tr>
            </thead>
            <tbody id="invoiceTableBody">
                <!-- Dynamically generated rows -->
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <h5 class="text-custom">Total Pembayaran:</h5>
            <h5 id="totalAmount">Rp 0</h5>
        </div>
    </div>

    <script>
        const purchasedMedications = [
            { name: 'Paracetamol', dosage: '500 mg', usage: 'Dua kali sehari', quantity: 2, price: 2000 },
            { name: 'Amoxicillin', dosage: '250 mg', usage: 'Tiga kali sehari', quantity: 1, price: 5000 },
            { name: 'Ibuprofen', dosage: '400 mg', usage: 'Setelah makan', quantity: 3, price: 3000 },
        ];

        function populateInvoiceTable() {
            const tableBody = document.getElementById('invoiceTableBody');
            let total = 0;

            purchasedMedications.forEach(med => {
                const row = document.createElement('tr');
                const totalPrice = med.price * med.quantity;
                total += totalPrice;

                row.innerHTML = `
                    <td>${med.name}</td>
                    <td>${med.dosage}</td>
                    <td>${med.usage}</td>
                    <td>${med.quantity}</td>
                    <td>${totalPrice.toLocaleString()}</td>
                `;

                tableBody.appendChild(row);
            });

            document.getElementById('totalAmount').textContent = `Rp ${total.toLocaleString()}`;
        }

        // Populate the table on load
        window.onload = populateInvoiceTable;
    </script>
</body>
</html>
