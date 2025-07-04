<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body { font-family: sans-serif; padding: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 5px 0; }
        table { border-collapse: collapse; width: 100%; font-size: 12px; }
        th { background-color: #007BFF; color: white; padding: 8px; border: 1px solid #555; }
        td { border: 1px solid #555; padding: 8px; vertical-align: top; }
        ul { margin: 0; padding-left: 20px; }
        .total-footer { margin-top: 20px; text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $logo }}" alt="Logo Toko" style="height:80px;">
        <h2>Struk Transaksi</h2>
        <p>{{ date('d-m-Y H:i') }}</p>
    </div>

    <table>
        <tr>
            <td><strong>ID Transaksi</strong></td>
            <td>: {{ $transaction->id }}</td>
        </tr>
        <tr>
            <td><strong>Nama Pembeli</strong></td>
            <td>: {{ $transaction->name }}</td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td>: {{ $transaction->address ?? 'Tidak ada alamat' }}</td>
        </tr>
        <tr>
            <td><strong>Total Harga</strong></td>
            <td>: Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Barang yang Dibeli</strong></td>
            <td>: 
                <ul>
                    @foreach($products as $product)
                        <li>{{ $product['name'] }} x{{ $product['quantity'] }} ({{ number_format($product['price'], 0, ',', '.') }}) = Rp{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong>Total Pembayaran</strong></td>
            <td>: Rp{{ number_format($transaction->amount_paid, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Perubahan</strong></td>
            <td>: Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="total-footer">
        Total: Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
    </div>
</body>
</html>
