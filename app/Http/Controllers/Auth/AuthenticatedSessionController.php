<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi pengguna
        $request->authenticate();

        // Regenerasi session untuk mencegah session fixation
        $request->session()->regenerate();
        \Log::info('Login berhasil, mengalihkan ke produk yang bisa dibeli.');

        // Arahkan ke halaman produk yang bisa dibeli setelah login
        return redirect()->route('produk.index');  // Produk yang bisa dibeli
    }

    /**
     * Logout dan hapus sesi autentikasi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna
        Auth::guard('web')->logout();

        // Menghapus session dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama setelah logout
        return redirect('/');
    }
}
