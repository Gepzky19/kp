<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'amount_paid' => 'required|numeric|min:0'
        ]);

        $user = User::where('name', $validated['name'])->first();
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $cartItems = Cart::where('user_id', $user->id)->where('status', 'checked_out')->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Tidak ada keranjang untuk dibayar'], 404);
        }

        $totalPrice = 0;
        $productList = [];

        foreach ($cartItems as $item) {
            $totalPrice += $item->quantity * $item->product->price;
            $productList[] = [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ];
        }

        if ($validated['amount_paid'] < $totalPrice) {
            return response()->json(['message' => 'Uang tidak cukup', 'total_price' => $totalPrice], 400);
        }

        foreach ($cartItems as $item) {
            $item->status = 'paid';
            $item->save();

            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        // Simpan ke tabel transaksi (struk)
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'address' => $user->address,
            'products' => json_encode($productList),
            'total_price' => $totalPrice,
            'amount_paid' => $validated['amount_paid'],
            'change' => $validated['amount_paid'] - $totalPrice,
            'paid_at' => Carbon::now()
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil',
            'transaction' => $transaction
        ]);
    }
}
