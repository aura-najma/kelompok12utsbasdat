<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Checkout Obat</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 5rem;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .text-custom {
            color: #2295B4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-custom">Checkout Obat</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga Satuan (Rp)</th>
                    <th>Jumlah</th>
                    <th>Total (Rp)</th>
                </tr>
            </thead>
            <tbody id="checkoutTableBody">
                <!-- Dynamically generated rows -->
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <h5 class="text-custom">Total Pembayaran:</h5>
            <h5 id="totalAmount">Rp 0</h5>
        </div>
        <div class="text-center mt-4">
            <button type="button" class="btn btn-success" onclick="proceedToInvoice()">Lanjut ke Invoice</button>
        </div>
    </div>

    <script>
        const medications = [
            { name: 'Paracetamol', price: 2000, quantity: 2 },
            { name: 'Amoxicillin', price: 5000, quantity: 1 },
            { name: 'Ibuprofen', price: 3000, quantity: 3 },
        ];

        function populateCheckoutTable() {
            const tableBody = document.getElementById('checkoutTableBody');
            let total = 0;

            medications.forEach((med, index) => {
                const row = document.createElement('tr');
                const totalPrice = med.price * med.quantity;
                total += totalPrice;

                row.innerHTML = `
                    <td>${med.name}</td>
                    <td>${med.price.toLocaleString()}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(${index}, -1)">-</button>
                            <input type="number" class="form-control mx-2" value="${med.quantity}" min="0" max="3" onchange="updateTotal()" style="width: 60px;" />
                            <button class="btn btn-outline-secondary" onclick="changeQuantity(${index}, 1)">+</button>
                        </div>
                    </td>
                    <td class="totalPrice">${totalPrice.toLocaleString()}</td>
                `;

                tableBody.appendChild(row);
            });

            updateTotal();
        }

        function changeQuantity(index, delta) {
            const medication = medications[index];
            const input = document.querySelectorAll('input[type="number"]')[index];
            const stock = 3; // Example max stock
            const newQuantity = Math.min(Math.max(medication.quantity + delta, 0), stock);
            medication.quantity = newQuantity;
            input.value = newQuantity;
            updateTotal();
        }

        function updateTotal() {
            const totalAmountElement = document.getElementById('totalAmount');
            const rows = document.querySelectorAll('#checkoutTableBody tr');
            let total = 0;

            rows.forEach((row, index) => {
                const priceCell = row.querySelector('td:nth-child(2)');
                const quantityCell = row.querySelector('input[type="number"]');
                const totalPriceCell = row.querySelector('.totalPrice');
                const totalPrice = parseInt(priceCell.textContent.replace(/[^0-9]/g, '')) * quantityCell.value;
                totalPriceCell.textContent = totalPrice.toLocaleString();
                total += totalPrice;
            });

            totalAmountElement.textContent = `Rp ${total.toLocaleString()}`;
        }

        function proceedToInvoice() {
            window.location.href = "{{ url('invoicetransaksi') }}"; // Redirect to Invoice page
        }

        // Populate the table on load
        window.onload = populateCheckoutTable;
    </script>
</body>
</html>
