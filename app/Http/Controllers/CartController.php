<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'products' => 'required|array', // Mengubah untuk menerima banyak produk
        'products.*.product_id' => 'required|exists:products,id', // Validasi setiap produk
        'products.*.quantity' => 'required|integer|min:1' // Validasi kuantitas
    ]);

    // Buat user jika belum ada
    $user = User::firstOrCreate(
        ['name' => $validated['name']],
        [
            'email' => strtolower(str_replace(' ', '', $validated['name'])) . '@example.com',
            'password' => bcrypt('defaultpassword'),
            'role' => 'user'
        ]
    );

    // Loop untuk menambahkan setiap produk ke keranjang
    foreach ($validated['products'] as $productData) {
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $productData['product_id'];
        $cart->quantity = $productData['quantity'];
        $cart->status = 'pending';
        $cart->save();
    }

    return response()->json(['message' => 'Produk berhasil dimasukkan ke keranjang']);
}

}
