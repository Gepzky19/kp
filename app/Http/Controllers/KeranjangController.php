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

        if (isset($keranjang[$product->id])) {
            $keranjang[$product->id]['quantity'] += $validated['quantity'];
        } else {
            $keranjang[$product->id] = [
                "name" => $product->name,
                "quantity" => $validated['quantity'],
                "price" => $product->price,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.show')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Menampilkan halaman keranjang
    public function showKeranjang()
    {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.keranjang', compact('keranjang'));
    }

    // Fungsi untuk menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
            return redirect()->route('keranjang.show')->with('success', 'Produk berhasil dihapus dari keranjang!');
        }

        return redirect()->route('keranjang.show')->with('error', 'Produk tidak ditemukan di keranjang!');
    }

    // Menampilkan halaman pembayaran dan memproses pembayaran
    public function pembayaran(Request $request)
{
    $keranjang = session()->get('keranjang', []);
    $totalPrice = 0;

    // Menghitung total harga pembelian
    foreach ($keranjang as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    // Ambil jumlah pembayaran dari input
    $amountPaid = $request->input('amount_paid', 0);
    $change = 0;

    // Cek apakah jumlah pembayaran cukup
    if ($amountPaid < $totalPrice) {
        return back()->with('error', 'Jumlah pembayaran tidak cukup.');
    }

    // Hitung kembalian
    $change = $amountPaid - $totalPrice;

    // Proses pembayaran dan kurangi stok
    foreach ($keranjang as $productId => $item) {
        $product = Product::find($productId);

        if ($product && $product->stock >= $item['quantity']) {
            // Kurangi stok produk
            $product->stock -= $item['quantity'];
            $product->save();

            // Simpan transaksi
            Transaction::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'total_price' => $item['quantity'] * $product->price,
            ]);
        } else {
            return redirect()->route('keranjang.show')->with('error', 'Stok produk tidak cukup!');
        }
    }

    // Hapus keranjang setelah checkout
    session()->forget('keranjang');

    // Tampilkan halaman pembayaran dengan kembalian
    return view('keranjang.pembayaran', compact('totalPrice', 'amountPaid', 'change'));
}

}
