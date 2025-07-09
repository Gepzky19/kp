@php
    use Illuminate\Support\Facades\Route;
@endphp

<x-guest-layout>
    <style>
    .overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: -1;
    }

    .struk-container {
        background-color: rgba(255, 255, 255, 0.96);
        border-radius: 12px;
        padding: 30px;
        max-width: 700px;
        margin: 30px auto;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
    }

    .back-button {
        position: absolute;
        top: 15px;
        left: 15px;
        font-size: 22px;
        font-weight: bold;
        color: #dc2626;
        text-decoration: none;
        z-index: 2;
    }

    .back-button:hover {
        color: #b91c1c;
    }

    .logo-center {
        position: relative;
        margin-top: 0;
        margin-bottom: 15px;
        text-align: center;
        z-index: 1;
    }

    .logo-center img {
        height: 44px;
        object-fit: contain;
        max-width: 120px;
        margin: 0 auto;
    }
</style>


    <div class="overlay"></div>

    <div class="struk-container">
        <!-- Tombol kembali -->
        <a href="{{ url('/admin/dashboard') }}" class="back-button">&lt;</a>

        <!-- Logo center -->
        <div class="logo-center">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo">
        </div>

        {{-- Notifikasi error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">🧾 Cetak Struk Transaksi - Admin</h2>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.receipt.post') }}" method="POST"
              class="bg-white border border-gray-200 rounded-lg px-6 py-5 shadow-sm">
            @csrf
            <label for="name" class="block text-gray-700 font-bold mb-2">Masukkan Nama Pengguna:</label>
            <input type="text" name="name" id="name" required placeholder="Nama lengkap pembeli"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <button type="submit"
                    class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">
                🔍 Cari
            </button>
        </form>

        <!-- Tampilkan Struk jika ditemukan -->
        @isset($transaction)
            <div class="mt-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Struk Transaksi</h3>
                <table class="table-auto w-full text-sm text-gray-800">
                    <tbody>
                        <tr><td class="font-medium w-40">🆔 ID Transaksi</td><td>{{ $transaction->id }}</td></tr>
                        <tr><td class="font-medium">👤 Nama Pembeli</td><td>{{ $transaction->name }}</td></tr>
                        <tr><td class="font-medium">🏠 Alamat</td><td>{{ $transaction->address ?? 'Tidak ada alamat' }}</td></tr>
                        <tr><td class="font-medium">💰 Total Harga</td><td>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td></tr>
                        <tr>
                            <td class="font-medium">🛒 Barang</td>
                            <td>
                                <ul>
                                    @foreach($products as $product)
                                        <li>{{ $product['name'] }} x{{ $product['quantity'] }} = Rp{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr><td class="font-medium">💳 Total Bayar</td><td>Rp{{ number_format($transaction->amount_paid, 0, ',', '.') }}</td></tr>
                        <tr><td class="font-medium">💸 Kembalian</td><td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td></tr>
                    </tbody>
                </table>

                <!-- Tombol Download Struk -->
                <form action="{{ route('admin.downloadReceipt', $transaction->id) }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
                        ⬇️ Download Struk
                    </button>
                </form>
            </div>
        @endisset
    </div>
</x-guest-layout>
