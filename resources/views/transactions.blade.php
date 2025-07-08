<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; padding: 10px; }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header h2 {
            margin: 5px 0;
            color: #333;
        }
        .back-button {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            text-decoration: none;
            color: #d40000;
            padding: 4px 12px;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #e6f0ff;
        }
        table { border-collapse: collapse; width: 100%; font-size: 12px; }
        th { background-color: #d40000; color: white; padding: 8px; border: 1px solid #555; }
        td { border: 1px solid #555; padding: 8px; vertical-align: top; }
        ul { margin: 0; padding-left: 20px; }
        .total-footer {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ url('/admin/dashboard') }}" class="back-button">&lt;</a>
        <img src="{{ $logo }}" alt="Logo Toko" style="height:80px;">
        <h2>Laporan Transaksi</h2>
        <p>{{ date('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Dibayar</th>
                <th>Kembalian</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($transactions as $tx)
                @php
                    $customer = $tx->name ?? '-';
                    $total = $tx->total_price ?? 0;
                    $dibayar = $tx->amount_paid ?? 0;
                    $kembalian = $tx->change ?? 0;
                    $grandTotal += $total;

                    $productsRaw = $tx->products;
                    $products = [];

                    if (is_array($productsRaw)) {
                        $products = $productsRaw;
                    } elseif (is_string($productsRaw)) {
                        $decodedOnce = json_decode($productsRaw, true);
                        if (is_array($decodedOnce)) {
                            if (isset($decodedOnce[0]['name'])) {
                                $products = $decodedOnce;
                            } elseif (is_string($decodedOnce)) {
                                $products = json_decode($decodedOnce, true) ?? [];
                            }
                        }
                    }
                @endphp
                <tr>
                    <td>{{ $customer }}</td>
                    <td>{{ \Carbon\Carbon::parse($tx->paid_at)->format('d-m-Y H:i') }}</td>
                    <td>
                        <ul>
                            @foreach($products as $product)
                                <li>{{ $product['name'] ?? '' }} x{{ $product['quantity'] ?? 1 }} ({{ number_format($product['price'] ?? 0, 0, ',', '.') }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($total, 0, ',', '.') }}</td>
                    <td>{{ number_format($dibayar, 0, ',', '.') }}</td>
                    <td>{{ number_format($kembalian, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-footer">
        Total Penjualan: Rp{{ number_format($grandTotal, 0, ',', '.') }}
    </div>
</body>
</html>
