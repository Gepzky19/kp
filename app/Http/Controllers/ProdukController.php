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
}
