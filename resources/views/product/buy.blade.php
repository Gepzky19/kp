@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout Produk</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <!-- Formulir Checkout -->
            <form action="{{ route('produk.checkout', $product->id) }}" method="POST">
                @csrf

                <!-- Alamat Pengiriman -->
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>

                <!-- Tombol untuk mengonfirmasi pembelian -->
                <button type="submit" class="btn btn-success">Konfirmasi Pembelian</button>
            </form>
        </div>
    </div>
</div>
@endsection
