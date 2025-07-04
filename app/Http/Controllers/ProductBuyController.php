<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;  // Model untuk transaksi, jika sudah ada
use Illuminate\Http\Request;

class ProductBuyController extends Controller
{
    
    // Menampilkan produk yang bisa dibeli
    public function showProductForSale()
    {
        // Mengambil semua produk yang dapat dibeli
        $products = Product::all();
        return view('product.product_buy', compact('products'));
    }

    // Menangani pembelian produk
    public function buy($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);
        return view('product.buy', compact('product'));
    }

    // Proses checkout
    public function checkout(Request $request, $id)
    {
        // Mendapatkan produk yang dibeli berdasarkan ID
        $product = Product::findOrFail($id);

        // Validasi data yang dikirimkan oleh pengguna
        $validated = $request->validate([
            'address' => 'required|string|max:255', // Validasi alamat
            'payment_method' => 'required|string', // Validasi metode pembayaran
        ]);

        // Simpan transaksi ke database
        $transaction = new Transaction();
        $transaction->user_id = auth()->id();  // ID user yang sedang login
        $transaction->product_id = $product->id;
        $transaction->amount = $product->price;
        $transaction->status = 'pending';  // Status transaksi bisa "pending" atau "completed"
        $transaction->address = $validated['address'];
        $transaction->payment_method = $validated['payment_method'];
        $transaction->quantity = 1; // Misalnya 1 produk dibeli
        $transaction->total_price = $product->price; // Total harga berdasarkan produk yang dibeli
        $transaction->save();

        // Proses pembayaran (misalnya menggunakan payment gateway)
        // Setelah pembayaran selesai, status transaksi bisa diubah
        // Untuk simulasi, kita anggap transaksi selesai
        $transaction->status = 'completed';
        $transaction->save();

        // Arahkan ke halaman konfirmasi setelah checkout
        return redirect()->route('produk.terima-kasih', ['id' => $transaction->id]);
    }

    // Halaman terima kasih setelah transaksi selesai
    public function thankYou($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Tampilkan halaman terima kasih setelah pembelian
        return view('product.thank_you', compact('transaction'));
    }
}
