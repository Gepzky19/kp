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
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="logo-img" />
            <span>ISKANDARTEX</span>
        </div>

        <ul class="nav-menu">
            <!-- Link ke halaman produk -->
            <li><a href="{{ route('produk.index') }}">Produk</a></li>

            <!-- Link ke halaman keranjang -->
            <li>
                <a href="{{ route('keranjang.show') }}" class="btn-keranjang">
                    Keranjang 
                    <span class="badge badge-pill badge-danger">
                        {{ count(session('keranjang', [])) }}
                    </span>
                </a>
            </li>

            <!-- Tombol logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger ms-3">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
