@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout Produk</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pembelian: {{ $product->name }}</h5>
            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <!-- Bisa menambahkan form untuk pembayaran atau konfirmasi -->
            <form method="POST">
                @csrf
                <!-- Form pembayaran atau konfirmasi lainnya -->
                <button type="submit" class="btn btn-success">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection
