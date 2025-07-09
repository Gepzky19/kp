 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst($kategori ?? 'Semua Produk') }} - Iskandartex</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="navbar">
        <div class="logo">ISKANDARTEX</div>
        <ul class="nav-menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'man']) }}">Man</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'women']) }}">Women</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'couple']) }}">Couple</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'sarung']) }}">Sarung</a></li>
            <li><a href="{{ route('produk.kategori', ['kategori' => 'bahan']) }}">Bahan</a></li>
        </ul>
    </div>

    <div class="produk-page">
        <h2 class="judul-halaman">{{ ucfirst($kategori ?? 'Semua Produk') }}</h2>

        <div class="produk-container">
            @forelse ($products as $product)
                <div class="produk-card">
                    @if ($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="no-image">Tidak ada gambar</div>
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <p>Kategori: {{ $product->category }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            @empty
                <p class="no-produk">produk belom terupload</p>
            @endforelse
        </div>
    </div>
</body>
</html>
