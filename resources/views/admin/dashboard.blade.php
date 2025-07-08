<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f4f4f4; }
        h2 {
            text-align: center;
            font-size: 30px;
            color: #333;
        }
        section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 0 auto;
            width: 80%;
            max-width: 500px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 15px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 5px;
        }
        a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: white;
            font-size: 18px;
        }
        a:hover {
            background-color: #45a049;
        }
        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Dashboard Admin</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <ul>
            <!-- Tombol Edit Stok dan Harga Produk, mengarah ke halaman edit -->
            <li>
                <a href="{{ url('/admin/products/edit') }}">Edit Stok dan Harga Produk</a>
            </li>
            <!-- Tombol untuk melihat laporan transaksi -->
            <li>
                <a href="{{ url('/admin/report?admin=Admin') }}">Lihat Laporan Transaksi</a>
            </li>
            <!-- Tombol untuk mencetak struk -->
            <li>
                <a href="{{ url('/admin/receipt') }}">Cetak Struk</a>
            </li>
        </ul>
    </section>

</body>
</html>
