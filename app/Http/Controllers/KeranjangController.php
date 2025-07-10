<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Fungsi untuk menambah produk ke keranjang
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $keranjang = session()->get('keranjang', []);

        // Cek apakah produk sudah ada di keranjang
        if (isset($keranjang[$product->id])) {
            $keranjang[$product->id]['quantity'] += $validated['quantity'];  // Tambahkan jumlah produk
        } else {
            $keranjang[$product->id] = [
                "name" => $product->name,
                "quantity" => $validated['quantity'],
                "price" => $product->price,
            ];
        }

        // Simpan data keranjang ke session
        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.show')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Menampilkan halaman keranjang
    public function showKeranjang()
    {
        $keranjang = session()->get('keranjang', []);  // Ambil data keranjang dari session
        return view('keranjang.keranjang', compact('keranjang'));
    }

    // Fungsi untuk menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        $keranjang = session()->get('keranjang', []);

        // Cek jika produk ada di keranjang, lalu hapus
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);  // Simpan perubahan ke session
            return redirect()->route('keranjang.show')->with('success', 'Produk berhasil dihapus dari keranjang!');
        }

        return redirect()->route('keranjang.show')->with('error', 'Produk tidak ditemukan di keranjang!');
    }

    public function showPembayaran()
{
    $keranjang = session()->get('keranjang', []);
    $totalPrice = 0;

    foreach ($keranjang as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    return view('keranjang.pembayaran', compact('keranjang', 'totalPrice'));
}

    // Menampilkan halaman pembayaran dan memproses pembayaran
public function pembayaran(Request $request)
{
    $keranjang = session()->get('keranjang', []);  // Ambil keranjang dari session
    $totalPrice = 0;

    // Menghitung total harga pembelian
    foreach ($keranjang as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    // Ambil jumlah pembayaran dari input user
    $amountPaid = $request->input('amount_paid', 0);
    $change = 0;

    // Cek apakah pembayaran cukup
    if ($amountPaid < $totalPrice) {
        return back()->with('error', 'Jumlah pembayaran tidak cukup.');
    }

    // Hitung kembalian
    $change = $amountPaid - $totalPrice;

    // Proses pembayaran dan update stok
    foreach ($keranjang as $productId => $item) {
        $product = Product::find($productId);  // Ambil data produk

        // Pastikan stok cukup sebelum diproses
        if ($product && $product->stock >= $item['quantity']) {
            // Kurangi stok produk
            $product->stock -= $item['quantity'];
            $product->save();  // Simpan perubahan stok

            // Simpan transaksi ke database
            Transaction::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'name' => $product->name, // tambahkan ini
                'quantity' => $item['quantity'],
                'total_price' => $item['quantity'] * $product->price,
            ]);

        } else {
            // Jika stok tidak cukup, tampilkan pesan error
            return redirect()->route('keranjang.show')->with('error', 'Stok produk tidak cukup!');
        }
    }

    // Hapus keranjang setelah transaksi selesai
    session()->forget('keranjang');

    // Tampilkan halaman pembayaran dengan kembalian
    return view('keranjang.pembayaran', compact('totalPrice', 'amountPaid', 'change'));
}

}
