<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

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



//public function update(Request $request, $id)
//{
    // Validasi input harga, stok, dan kategori
//    $request->validate([
//        'harga' => 'required|numeric',
//        'stok' => 'required|numeric',
//        'category' => 'required|string|in:man,women,couple,sarung,bahan',
//    ]);

    // Temukan produk berdasarkan ID
//    $product = Product::findOrFail($id);

    // Update harga, stok, dan kategori produk
//    $product->price = $request->input('harga');
//    $product->stock = $request->input('stok');
//    $product->category = $request->input('category');

    // Simpan perubahan ke database
//    $product->save();

    // Kembali ke halaman editProduct dengan pesan sukses
//    return redirect()->route('admin.editProduct', $id)->with('success', 'Produk berhasil diperbarui');
//}

public function update(Request $request, $id)
{
   $request->validate([
    'name' => 'required|string|max:255', // ✅ tambahkan validasi nama
    'harga' => 'required|numeric',
    'stok' => 'required|numeric',
    'category' => 'required|string|in:man,women,couple,sarung,bahan',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // ✅ update nama produk
        $product->name = $request->input('name');
        $product->price = $request->input('harga');
        $product->stock = $request->input('stok');
        $product->category = $request->input('category');


    // Jika ganti gambar
    if ($request->hasFile('image')) {
        $category = $request->input('category');
        $image = $request->file('image');
        $originalName = $image->getClientOriginalName();

        // Hapus gambar lama
        $oldPath = public_path('images/' . $product->image);
        if ($product->image && File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Simpan gambar baru
        $image->move(public_path('images/' . $category), $originalName);
        $product->image = $category . '/' . $originalName;
    }

    $product->save();

    return redirect()->back()->with('success', 'Produk berhasil diperbarui');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'category' => 'required|in:man,women,couple,sarung,bahan',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $image = $request->file('image');
    $originalName = $image->getClientOriginalName();
    $category = $request->input('category');

    // Simpan ke folder sesuai kategori
    $image->move(public_path('images/' . $category), $originalName);

    // Buat produk
    Product::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'stock' => $request->input('stock'),
        'category' => $category,
        'image' => $category . '/' . $originalName,
    ]);

    return back()->with('success', 'Produk berhasil ditambahkan');
}




}
