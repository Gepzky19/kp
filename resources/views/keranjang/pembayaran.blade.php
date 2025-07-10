@extends('layouts.produk')

@section('content')
<div class="container">
    <h1>Halaman Pembayaran</h1>

    @php
        // Mendapatkan waktu kadaluarsa dari session
        $expiryTime = session('payment_expiry');
        $currentTime = now();
        $isExpired = $currentTime->greaterThan($expiryTime);
    @endphp

    <!-- Menampilkan pesan jika pembayaran kadaluarsa -->
    @if($isExpired)
    <div class="alert alert-danger mt-3">
        <h4>Waktu pembayaran telah kadaluarsa! Silakan melakukan pemesanan ulang.</h4>
    </div>
    @else
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

            <!-- Menampilkan pesan pembayaran berhasil jika pembayaran sukses -->
            @if(session('success'))
            <div class="alert alert-success mt-3">
                <h4>{{ session('success') }}</h4>
            </div>
            @endif

            <!-- Menampilkan pesan error jika ada -->
            @if(session('error'))
            <div class="alert alert-danger mt-3">
                <h4>{{ session('error') }}</h4>
            </div>
            @endif
        </div>
    </div>

    <!-- Menampilkan countdown timer jika belum kadaluarsa -->
    <div id="countdown" class="mt-3">
        @if(!$isExpired)
            <h4>Waktu Tersisa: <span id="timer"></span></h4>
        @endif
    </div>

    @endif
</div>

<script>
// Mengambil waktu kadaluarsa dari server (waktu kadaluarsa yang sudah disimpan di session)
var expiryTime = new Date("{{ $expiryTime }}").getTime();

// Update timer setiap detik
var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = expiryTime - now;

    // Hitung waktu yang tersisa dalam jam, menit, dan detik
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Menampilkan waktu yang tersisa
    document.getElementById("timer").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

    // Jika timer sudah selesai, tampilkan pesan kadaluarsa
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "Waktu Kadaluarsa";
        document.getElementById("countdown").innerHTML = "<div class='alert alert-danger'>Waktu pembayaran telah kadaluarsa! Silakan melakukan pemesanan ulang.</div>";
    }
}, 1000);
</script>

@endsection
