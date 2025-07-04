<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|in:man,woman,kid,couple',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path; // simpan sebagai 'image' bukan 'image_path'
        }

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product added',
            'product' => $product
        ], 201);
    }

    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $product->image_url = $product->image
                ? asset('storage/' . $product->image)
                : null;
            return $product;
        });

        return view('product.produk', ['products' => $products]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
