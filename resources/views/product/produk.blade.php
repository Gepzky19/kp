<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($kategori) }} - TokoKeren</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="navbar">
        <div class="logo">TokoKeren</div>
        <ul class="nav-menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'man']) }}">Man</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'women']) }}">Women</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'couple']) }}">Couple</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'sarung']) }}">Sarung</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'bahan']) }}">Bahan</a></li>
        </ul>
    </div>

    <section class="produk">
        <h2>Produk Kategori: {{ ucfirst($kategori) }}</h2>

        <div class="produk-container">
            @foreach ($products as $product)
                <div class="produk-card">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" width="100">
                    @else
                        <img src="{{ asset('images/man/hem-pndk-1.png') }}" alt="Tidak ada gambar" width="100">
                    @endif

                    <h3>{{ $product->name }}</h3>
                    <h4>{{ $product->stock }}</h4>
                    <p>{{ $product->category }}</p>
                    <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                </div>
            @endforeach
        </div>
    </section>
</body>

</html>
