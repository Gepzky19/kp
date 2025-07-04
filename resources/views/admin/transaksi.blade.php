<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>
<body>
    <h2>Laporan Transaksi</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ayu</td>
                <td>Batik Solo</td>
                <td>Rp150.000</td>
                <td>2025-05-23</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Budi</td>
                <td>Batik Tulis</td>
                <td>Rp200.000</td>
                <td>2025-05-21</td>
            </tr>
        </tbody>
    </table>

    <p>
        <a href="{{ url('/admin') }}">Kembali ke Upload Produk</a>
    </p>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>


</body>
</html>
