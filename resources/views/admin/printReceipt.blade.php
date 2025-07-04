<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 60px;
        }
        .header h2 {
            font-size: 20px;
            margin: 10px 0;
        }
        .header p {
            font-size: 14px;
            color: #555;
        }
        .details {
            margin-bottom: 20px;
        }
        .details td {
            padding: 5px;
        }
        .details th {
            text-align: left;
            font-weight: bold;
        }
        .total-footer {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $logo }}" alt="Logo Toko">
            <h2>Struk Transaksi</h2>
            <p>{{ date('d-m-Y H:i') }}</p>
        </div>

        <div class="details">
            <table style="width: 100%; font-size: 14px;">
                <tr>
                    <th>ID Transaksi</th>
                    <td>: {{ $transaction->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pembeli</th>
                    <td>: {{ $transaction->name }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $transaction->address ?? 'Tidak ada alamat' }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>: Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Barang yang Dibeli</th>
                    <td>
                        <ul>
                            @foreach($products as $product)
                                <li>{{ $product['name'] }} x{{ $product['quantity'] }} ({{ number_format($product['price'], 0, ',', '.') }}) = Rp{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td>: Rp{{ number_format($transaction->amount_paid, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td>: Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="total-footer">
            Total: Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
        </div>
    </div>
</body>
</html>
