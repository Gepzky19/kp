@extends('layouts.produk')

@section('content')
<div class="container">
    <h1>Produk yang Tersedia untuk Pembelian</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4"> <!-- Menyesuaikan ukuran kolom -->
            <div class="card" style="height: 100%;">
                <!-- Menampilkan gambar produk dengan ukuran yang lebih kecil -->
                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body" style="height: 250px;"> <!-- Menyesuaikan tinggi card -->
                    <h5 class="card-title" style="font-size: 1.1em;">{{ $product->name }}</h5>
                    <p class="card-text" style="font-size: 0.9em;">{{ $product->description }}</p>
                    <p class="card-text" style="font-size: 1em;">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="card-text" style="font-size: 0.9em;">Stok: {{ $product->stock }}</p>
                    
                    <!-- Form untuk menambahkan produk ke keranjang -->
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <!-- Input untuk mengubah jumlah produk -->
                        <div class="input-group">
                            <button type="button" class="btn btn-secondary" id="minus-{{ $product->id }}" onclick="changeQuantity({{ $product->id }}, 'minus')">-</button>
                            <input type="number" name="quantity" id="quantity-{{ $product->id }}" class="form-control" value="0" min="0" max="{{ $product->stock }}">
                            <button type="button" class="btn btn-secondary" id="plus-{{ $product->id }}" onclick="changeQuantity({{ $product->id }}, 'plus')">+</button>
                        </div>
                        
                        <!-- Tombol Tambahkan ke Keranjang -->
                        <button type="submit" class="btn btn-keranjang mt-3">Tambahkan ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    // Fungsi untuk mengubah jumlah produk
    function changeQuantity(productId, action) {
        var quantityInput = document.getElementById('quantity-' + productId);
        var currentQuantity = parseInt(quantityInput.value);

        // Jika tombol 'plus' ditekan dan kuantitas kurang dari stok
        if (action === 'plus' && currentQuantity < parseInt(quantityInput.max)) {
            quantityInput.value = currentQuantity + 1;
        } 
        // Jika tombol 'minus' ditekan dan kuantitas lebih dari 1
        else if (action === 'minus' && currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        }
    }
</script>
@endsection
