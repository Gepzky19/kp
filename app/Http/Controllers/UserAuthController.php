<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Check input
        $request->validate(([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required | min:6',
        ]));
        // Membuat user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // retun
        return redirect('/user/login')->with('success', 'register berhasil');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak ditemukan',
        ]);
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'email' => 'Password salah',
        ]);
    }

    Auth::login($user);
    $request->session()->regenerate();

    // Ganti redirect ke halaman kategori produk
    return redirect()->intended('/produk');
}

}
