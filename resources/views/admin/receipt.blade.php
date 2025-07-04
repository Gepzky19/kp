<!-- resources/views/admin/receipt.blade.php -->
@php
    use Illuminate\Support\Facades\Route;
@endphp

<x-guest-layout>
    <!-- Status Session -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="text-xl font-semibold">Cetak Struk Transaksi - Admin</h2>

    <!-- Form Pencarian -->
    <form action="{{ route('admin.receipt.post') }}" method="POST">
        @csrf
        <label for="name">Masukkan Nama Pengguna:</label>
        <input type="text" name="name" id="name" required class="block mt-1 w-full" placeholder="Masukkan Nama Pengguna">
        <button type="submit" class="btn btn-primary mt-3">Cari</button>
    </form>

    <!-- Tampilkan Struk jika Ditemukan -->
    @isset($transaction)
        <div class="mt-6">
            <h3>Struk Transaksi</h3>
            <table class="table-auto">
                <tr><td><strong>ID Transaksi:</strong></td><td>{{ $transaction->id }}</td></tr>
                <tr><td><strong>Nama Pembeli:</strong></td><td>{{ $transaction->name }}</td></tr>
                <tr><td><strong>Alamat:</strong></td><td>{{ $transaction->address ?? 'Tidak ada alamat' }}</td></tr>
                <tr><td><strong>Total Harga:</strong></td><td>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td></tr>
                <tr><td><strong>Barang yang Dibeli:</strong></td><td>
                    <ul>
                        @foreach($products as $product)
                            <li>{{ $product['name'] }} x{{ $product['quantity'] }} = Rp{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </td></tr>
                <tr><td><strong>Total Pembayaran:</strong></td><td>Rp{{ number_format($transaction->amount_paid, 0, ',', '.') }}</td></tr>
                <tr><td><strong>Kembalian:</strong></td><td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td></tr>
            </table>
            
            <!-- Tombol Download Struk -->
            <form action="{{ route('admin.downloadReceipt', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">Download Struk</button>
            </form>
        </div>
    @endisset
</x-guest-layout>
