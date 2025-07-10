@extends('layouts.produk')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @if(count($keranjang) > 0)
            @foreach($keranjang as $productId => $item)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <p class="card-text">Harga: Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="card-text">Jumlah: {{ $item['quantity'] }}</p>
                        
                        <!-- Tombol Hapus Produk -->
                        <a href="{{ route('keranjang.remove', $productId) }}" class="btn btn-danger btn-sm" style="position: absolute; bottom: 10px; right: 10px;">Hapus</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>Keranjang belanja Anda kosong.</p>
        @endif
    </div>

    <hr>
    <div class="mt-4">
        <h3>Total: Rp{{ number_format(array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $keranjang)), 0, ',', '.') }}</h3>

        <!-- Tombol Checkout -->
<a href="{{ route('keranjang.showPembayaran') }}" class="btn btn-success mt-4">Checkout</a>

    </div>
</div>
@endsection
