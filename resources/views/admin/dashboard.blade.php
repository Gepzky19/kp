<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: sans-serif;
            background: url('{{ asset("images/fabric/fabric17.jpeg") }}') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Efek gelap */
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .dashboard-container {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .dashboard-box {
            background: rgba(255, 255, 255, 0.539);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px 40px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }

        .dashboard-box h2 {
            font-size: 28px;
            color: #d40000;
            margin-bottom: 30px;
        }

        .dashboard-box ul {
            list-style: none;
            padding: 0;
        }

        .dashboard-box li {
            margin-bottom: 20px;
        }

        .dashboard-box a {
            display: block;
            background-color: #d40000;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .dashboard-box a:hover {
            background-color: #a80000;
        }

        .alert {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #d40000;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            z-index: 2;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .dashboard-box {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-container">
        <div class="dashboard-box">
            <h2>Dashboard Admin</h2>
            <ul>
                <li>
                    <a href="{{ url('/admin/products/edit') }}">Edit Stok & Harga Produk</a>
                </li>
                <li>
                    <a href="{{ url('/admin/report?admin=Admin') }}">Lihat Laporan Transaksi</a>
                </li>
                <li>
                    <a href="{{ url('/admin/receipt') }}">Cetak Struk</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
