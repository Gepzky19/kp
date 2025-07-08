@extends('layouts.produk')

@section('content')
<div class="container">
    <h1>Halaman Pembayaran</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Total Pembayaran: Rp{{ number_format($totalPrice, 0, ',', '.') }}</h3>
            
            <form action="{{ route('keranjang.pembayaran') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount_paid">Jumlah Pembayaran:</label>
                    <input type="number" name="amount_paid" id="amount_paid" class="form-control" value="{{ old('amount_paid') }}" min="0" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Proses Pembayaran</button>
            </form>

            <!-- Menampilkan Kembalian jika ada -->
            @if(isset($change))
            <div class="alert alert-info mt-3">
                <h4>Kembalian: Rp{{ number_format($change, 0, ',', '.') }}</h4>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
