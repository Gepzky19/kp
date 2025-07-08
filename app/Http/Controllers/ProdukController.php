<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProdukController extends Controller
{
    /**
     * Menampilkan produk per kategori dalam tampilan view (frontend)
     */
    public function showByCategory($kategori)
    {
        $products = Product::where('category', $kategori)->get();
        return view('product.kategori', compact('products', 'kategori'));
    }

    public function allproduk()
    {
        return view('product.tampilan');
    }
    /**
     * Menampilkan produk per kategori dalam format JSON (untuk Postman/API)
     */
    public function apiByCategory($category)
    {
        $allowedCategories = ['man', 'women', 'kids', 'couple', 'sarung', 'bahan'];

        if (!in_array($category, $allowedCategories)) {
            return response()->json(['error' => 'Kategori tidak valid'], 404);
        }

        $products = Product::where('category', $category)->get();

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }

public function edit(Request $request)
{
    // Ambil kategori dari URL
    $category = $request->query('category', 'man'); // Default ke 'man' jika kategori tidak ada

    // Ambil semua produk berdasarkan kategori yang dipilih
    $products = Product::where('category', $category)->get();

    // Kirimkan data produk ke view
    return view('admin.editProduct', compact('products'));
}



public function update(Request $request, $id)
{
    // Validasi input harga, stok, dan kategori
    $request->validate([
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'category' => 'required|string|in:man,women,couple,sarung,bahan',
    ]);

    // Temukan produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Update harga, stok, dan kategori produk
    $product->price = $request->input('harga');
    $product->stock = $request->input('stok');
    $product->category = $request->input('category');

    // Simpan perubahan ke database
    $product->save();

    // Kembali ke halaman editProduct dengan pesan sukses
    return redirect()->route('admin.editProduct', $id)->with('success', 'Produk berhasil diperbarui');
}





}
