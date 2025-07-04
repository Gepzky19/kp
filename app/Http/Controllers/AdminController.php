<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
     public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah admin ada di database berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        // Jika admin tidak ditemukan
        if (!$admin) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan',
            ]);
        }

        // Cek apakah password yang dimasukkan benar
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ]);
        }

        // Jika berhasil login, buat sesi dan redirect
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        // Redirect ke dashboard admin
        return redirect()->intended('/admin/dashboard');
    } 
    // Menampilkan halaman pencarian struk
    public function showReceiptForm()
    {
        return view('admin.receipt');
    }

    // Menangani pencarian struk berdasarkan nama pengguna
    public function getReceiptByName(Request $request)
    {
        $name = $request->input('name');
        $targetUser = User::where('name', 'like', trim($name))->first();

        if (!$targetUser) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Mendapatkan transaksi berdasarkan user_id
        $transaction = Transaction::where('user_id', $targetUser->id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Menyusun data produk
        $products = json_decode($transaction->products, true);

        // Kirim data ke view untuk struk transaksi
        return view('admin.receipt', [
            'transaction' => $transaction,
            'products' => $products,
        ]);
    }
}


