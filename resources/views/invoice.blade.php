<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgba(34, 149, 180, 0.2);
        }

        .invoice-container {
            background-color: white;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header .logo img {
            width: 150px; /* Sesuaikan ukuran logo */
        }

        .invoice-header .company-info {
            text-align: right;
        }

        .invoice-header .company-info p {
            margin: 0;
        }

        .client-info, .invoice-info {
            margin-bottom: 20px;
        }

        .client-info {
            font-size: 18px;
        }

        .client-info span {
            font-weight: bold;
        }

        .invoice-info span {
            font-weight: bold;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .invoice-total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .total-due {
            color: rgba(34, 149, 180);
        }

        .payment-info {
            font-size: 16px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .footer span {
            color: red;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Header -->
    <div class="invoice-header">
        <div class="logo">
            <img src="{{ asset('img/4.png') }}" alt="Logo"> <!-- Ganti logo dengan gambar 4.png -->
        </div>
        <div class="company-info">
            <p>SemogaSehat</p>
        </div>
    </div>

    <!-- Client Information -->
    <div class="client-info">
        <p>Aura</p>
        <p>Invoice Date: <span>May 24th, 2024</span></p>
        <p>Invoice No: <span>12345</span></p>
    </div>

    <!-- Table -->
    <table class="invoice-table">
        <thead>
            <tr>
                <th>QTY</th>
                <th>Description</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2</td>
                <td>Obat menghilangkan tugas</td>
                <td>$15.00</td>
                <td>$30.00</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Obat menghilangkan proker</td>
                <td>$10.00</td>
                <td>$40.00</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Obat membelah diri</td>
                <td>$7.00</td>
                <td>$35.00</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Due -->
    <p class="invoice-total">Total Due: <span class="total-due">$105.00</span></p>

    <!-- Payment Info -->
    <div class="payment-info">
        <p>Payment Info:</p>
        <p>Account No: <span>123567744</span></p>
        <p>Routing No: <span>120900547</span></p>
        <p>Due by: <span>May 30th, 2024</span></p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><span>❤️</span> Terima Kasih</p>
        <p>Semoga Lekas Sembuh</p>
    </div>
</div>

</body>
</html>
