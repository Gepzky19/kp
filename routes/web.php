<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ProductBuyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeranjangController;

/*
|--------------------------------------------------------------------------
| Halaman Utama dan Produk
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('beranda');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/produk/{kategori}', [ProdukController::class, 'showByCategory'])->name('produk.kategori');

/*
|--------------------------------------------------------------------------
| Admin Section
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth:admin');

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/report', [AdminReportController::class, 'showReport'])->name('admin.report');
    Route::get('/report/download', [AdminReportController::class, 'downloadReport'])->name('admin.report.download');

    Route::get('/receipt', [AdminController::class, 'showReceiptForm'])->name('admin.receipt');
    Route::post('/receipt', [AdminController::class, 'getReceiptByName'])->name('admin.receipt.post');

    Route::post('/downloadReceipt/{id}', [TransactionController::class, 'downloadReceipt'])->name('admin.downloadReceipt');
});

/*
|--------------------------------------------------------------------------
| Produk Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin/products/edit', [ProdukController::class, 'edit'])->name('admin.editProduct');
Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.updateProduct');
Route::post('/admin/products', [ProdukController::class, 'store'])->name('admin.storeProduct');
Route::get('/admin/dashboard', [ProdukController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
/*
|--------------------------------------------------------------------------
| User Section
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('user.dashboard');

    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
});
 Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');  // Tambahkan ini
    Route::post('/register', [UserAuthController::class, 'register']);  // Tambahkan ini

/*
|--------------------------------------------------------------------------
| Auth Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Keranjang / Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('/keranjang', [KeranjangController::class, 'showKeranjang'])->name('keranjang.show');
Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
Route::post('/cart/add', [KeranjangController::class, 'addToCart'])->name('cart.add');
Route::get('/keranjang/remove/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.remove');
Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.remove');

/*
|--------------------------------------------------------------------------
| Pembayaran & Checkout
|--------------------------------------------------------------------------
*/
Route::get('/keranjang/pembayaran', [KeranjangController::class, 'showPembayaran'])->name('keranjang.showPembayaran');
Route::get('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::post('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::post('/payment', [KeranjangController::class, 'payment'])->name('keranjang.payment');
Route::post('/keranjang/payment', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');

/*
|--------------------------------------------------------------------------
| Produk untuk Dibeli oleh User (Frontend)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/produk', [ProductBuyController::class, 'showProductForSale'])->name('produk.index');
    Route::get('/produk/{id}/beli', [ProductBuyController::class, 'buy'])->name('produk.beli');
    Route::post('/produk/{id}/checkout', [ProductBuyController::class, 'checkout'])->name('produk.checkout');
});

/*
|--------------------------------------------------------------------------
| Struk dan Transaksi
|--------------------------------------------------------------------------
*/
Route::get('/transaction/receipt/{name}', [TransactionController::class, 'getReceiptByName']);
Route::get('/transaction/receipt/print/{name}', [TransactionController::class, 'getReceiptByName']);
Route::get('/admin/receipt/print', [AdminController::class, 'getReceiptByName'])->name('admin.receipt');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Auth Scaffolding Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
