<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(34, 149, 180, 0.2);
        }
        .checkout {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .checkout table {
            width: 100%;
            border-collapse: collapse;
        }
        .checkout th, .checkout td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .checkout th {
            background-color: #f2f2f2;
        }
        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        /* CSS untuk memusatkan tombol */
        .btn-container {
            display: flex;
            justify-content: center; /* Memusatkan tombol secara horizontal */
            margin-top: 20px;
        }
        .btn {
            background-color: rgba(34, 149, 180);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <div class="checkout">
        <h1>Checkout</h1>
        <table>
            <thead>
                <tr>
                    <th>Obat</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
        </table>  

        <!-- Container tombol untuk memusatkan -->
        <div class="btn-container">
            <button class="btn">Beli Sekarang</button>
        </div>
    </div>
</body>
</html>
