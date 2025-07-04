<?php

// File: app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string'
        ]);

        $user = User::where('name', $validated['name'])->first();
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $cartItems = Cart::where('user_id', $user->id)->where('status', 'pending')->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang kosong'], 404);
        }

        $totalQuantity = $cartItems->sum('quantity');
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item->quantity * $item->product->price;
            $item->status = 'checked_out';
            $item->save();
        }

        return response()->json([
            'message' => 'Checkout berhasil',
            'user' => $validated['name'],
            'address' => $validated['address'],
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice
        ]);
    }
}
