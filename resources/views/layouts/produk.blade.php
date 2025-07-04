<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo/logo.png" alt="Logo" class="logo-img" />
            <span>ISKANDARTEX</span>
        </div>

        <ul class="nav-menu">
            <!-- Ganti 'Beranda' dengan 'Keranjang' -->
            <!-- Ganti 'Keranjang' dengan 'Produk' -->
<li><a href="{{ route('produk.index') }}">Produk</a></li>


            <!-- Tombol Keranjang dengan jumlah item di session -->
            <li><a href="{{ route('keranjang.show') }}" class="btn btn-primary">
                Keranjang 
                <span class="badge badge-pill badge-danger">
                    {{ count(session('keranjang', [])) }}
                </span>
            </a></li>

            
        </ul>
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
