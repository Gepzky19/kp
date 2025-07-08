<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
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
        input, textarea, button {
            width: 100%; padding: 10px; margin-top: 10px;
        }
        .input-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .input-group button {
            width: 40px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 20px;
        }
        .input-group input {
            width: 80%;
            text-align: center;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .product-list {
            margin-top: 20px;
        }
        .product-item {
            margin: 10px 0;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .navbar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .navbar a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }
        .navbar a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Produk</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
@endif


    <!-- Navbar untuk memilih kategori -->
    <div class="navbar">
        <a href="{{ url('/admin/products/edit?category=man') }}">Man</a>
        <a href="{{ url('/admin/products/edit?category=women') }}">Women</a>
        <a href="{{ url('/admin/products/edit?category=couple') }}">Couple</a>
        <a href="{{ url('/admin/products/edit?category=sarung') }}">Sarung</a>
        <a href="{{ url('/admin/products/edit?category=bahan') }}">Bahan</a>
    </div>

    <section>
        <!-- Menampilkan semua produk berdasarkan kategori yang dipilih -->
        <div class="product-list">
            <h3>Semua Produk</h3>
            @foreach ($products as $product)
                <div class="product-item">
                    <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p><strong>Kategori:</strong> {{ $product->category }}</p>

                    <!-- Form untuk mengedit harga, stok, dan kategori -->
                    <form action="{{ route('admin.updateProduct', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label>Nama Produk:</label>
                        <input type="text" name="nama" value="{{ $product->name }}" disabled>

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
    </section>

</body>
</html>
