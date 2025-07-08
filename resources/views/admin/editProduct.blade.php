<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 30px;
            background-color: #faf6ef;
        }

        /* Header: Tombol Kembali + Judul + Navbar */
        .edit-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .edit-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-button {
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            color: #d40000;
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .back-button:hover {
            background-color: #f5dede;
            border-radius: 4px;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
            color: #d40000;
        }

        .navbar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .navbar a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: white;
            color: #000;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .navbar a:hover {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        h3 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .alert {
            background-color: #e0ffe0;
            border: 1px solid #8bc34a;
            padding: 10px 15px;
            margin: 0 auto 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 5px;
            color: #4c803a;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
        }

        .product-card .image-placeholder {
            width: 100%;
            height: 150px;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            font-style: italic;
            color: #888;
            margin-bottom: 15px;
        }

        .product-card strong {
            font-size: 18px;
            color: #222;
        }

        .product-card p {
            margin: 6px 0;
            font-size: 14px;
            color: #444;
        }

        form {
            margin-top: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            font-size: 13px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 15px;
            background-color: #d40000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        button:hover {
            background-color: #bb0000;
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header dengan tombol kembali dan navbar -->
    <div class="edit-header-container">
        <div class="edit-title-group">
            <a href="{{ url('/admin/dashboard') }}" class="back-button">&lt;</a>
            <span class="title">Edit Produk</span>
        </div>

        <div class="navbar">
            <a href="{{ url('/admin/products/edit?category=man') }}">Man</a>
            <a href="{{ url('/admin/products/edit?category=women') }}">Women</a>
            <a href="{{ url('/admin/products/edit?category=couple') }}">Couple</a>
            <a href="{{ url('/admin/products/edit?category=sarung') }}">Sarung</a>
            <a href="{{ url('/admin/products/edit?category=bahan') }}">Bahan</a>
        </div>
    </div>

    <h3>{{ ucfirst(request('category') ?? 'Semua') }}</h3>

    <div class="product-list">
        @foreach ($products as $product)
            <div class="product-card">
                <div class="image-placeholder">Tidak ada gambar</div>
                <strong>{{ $product->name }}</strong>
                <p><strong>Kategori:</strong> {{ $product->category }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <form action="{{ route('admin.updateProduct', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label>Kategori:</label>
                    <select name="category" required>
                        <option value="man" {{ $product->category == 'man' ? 'selected' : '' }}>Man</option>
                        <option value="women" {{ $product->category == 'women' ? 'selected' : '' }}>Women</option>
                        <option value="couple" {{ $product->category == 'couple' ? 'selected' : '' }}>Couple</option>
                        <option value="sarung" {{ $product->category == 'sarung' ? 'selected' : '' }}>Sarung</option>
                        <option value="bahan" {{ $product->category == 'bahan' ? 'selected' : '' }}>Bahan</option>
                    </select>

                    <label>Harga:</label>
                    <input type="number" name="harga" value="{{ $product->price }}" required>

                    <label>Stok:</label>
                    <input type="number" name="stok" value="{{ $product->stock }}" required>

                    <button type="submit">Update Produk</button>
                </form>
            </div>
        @endforeach
    </div>

</body>
</html>
