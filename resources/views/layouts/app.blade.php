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
            <li><a href="">Beranda</a></li>
            <li class="dropdown">
                <a href="/produk/man">Produk</a>
                <ul class="dropdown-content">
                </ul>
            </li>
           
            <li><a href="{{ route('show.login') }}" class="btn-login">Login</a></li> <!-- Dipindah ke sini -->
        </ul>
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>