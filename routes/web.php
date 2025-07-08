<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ProductBuyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeranjangController;

// Route untuk menampilkan halaman pembayaran
// Route untuk menampilkan halaman pembayaran (GET)
// Rute untuk halaman edit produk
// Rute untuk memperbarui produk
// Rute untuk halaman edit produk


Route::get('/keranjang', [KeranjangController::class, 'showKeranjang'])->name('keranjang.show');

// Rute untuk menghapus produk dari keranjang
Route::get('/keranjang/remove/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.remove');

// Rute untuk mengarahkan ke halaman pembayaran
Route::post('/keranjang/payment', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::post('/keranjang/payment', [KeranjangController::class, 'pembayaran'])->name('keranjang.payment');


Route::get('/admin/products/edit', [ProdukController::class, 'edit'])->name('admin.editProduct');


Route::get('/admin/products/edit', [ProdukController::class, 'edit'])->name('admin.editProduct');

Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.updateProduct');

Route::get('/admin/products/{id}/edit', [ProdukController::class, 'edit'])->name('admin.editProduct');

Route::get('/admin/dashboard', [ProdukController::class, 'index'])->name('admin.dashboard');

Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.updateProduct');

Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.updateProduct');


Route::get('/admin/products/{id}/edit', [ProdukController::class, 'edit'])->name('admin.editProduct');
Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.updateProduct');

Route::post('/keranjang/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::get('/keranjang/pembayaran', [KeranjangController::class, 'showPembayaran'])->name('keranjang.showPembayaran');


Route::post('/keranjang/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');

Route::get('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');

// Route untuk memproses pembayaran (POST)
Route::post('/pembayaran', [KeranjangController::class, 'payment'])->name('keranjang.payment');


Route::post('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');

Route::post('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');


Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
Route::get('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('keranjang.pembayaran');
Route::post('/payment', [KeranjangController::class, 'payment'])->name('keranjang.payment');

Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');

Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.remove');


Route::get('/keranjang', [KeranjangController::class, 'showKeranjang'])->name('keranjang.show');
Route::post('/cart/add', [KeranjangController::class, 'addToCart'])->name('cart.add');


Route::post('/cart/add', [KeranjangController::class, 'addToCart'])->name('cart.add');

Route::get('/keranjang', [KeranjangController::class, 'showKeranjang'])->name('keranjang.show');
Route::post('/keranjang/add', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
Route::get('/keranjang/remove/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.remove');


Route::post('/admin/downloadReceipt/{id}', [TransactionController::class, 'downloadReceipt'])->name('admin.downloadReceipt');



Route::get('/transaction/receipt/print/{name}', [TransactionController::class, 'getReceiptByName']);
// File: routes/web.php

Route::get('/admin/receipt', [AdminController::class, 'showReceiptForm'])->name('admin.receipt');
Route::post('/admin/receipt', [AdminController::class, 'getReceiptByName'])->name('admin.receipt.post');


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');

// routes/web.php

// Rute untuk menampilkan form pencarian nama
Route::get('/admin/receipt', [AdminController::class, 'showReceiptForm'])->name('admin.receiptForm');

// Rute untuk mencari dan mencetak struk berdasarkan nama
Route::get('/admin/receipt/print', [AdminController::class, 'getReceiptByName'])->name('admin.receipt');


Route::get('/transaction/receipt/{name}', [TransactionController::class, 'getReceiptByName']);


// Rute untuk menampilkan produk yang bisa dibeli (halaman utama produk)
Route::middleware('auth')->get('/produk', [ProductBuyController::class, 'showProductForSale'])->name('produk.index');

// Rute untuk pembelian produk
Route::middleware('auth')->get('/produk/{id}/beli', [ProductBuyController::class, 'buy'])->name('produk.beli');

// Rute untuk checkout produk
Route::middleware('auth')->post('/produk/{id}/checkout', [ProductBuyController::class, 'checkout'])->name('produk.checkout');


Route::get('/admin/report', [AdminReportController::class, 'showReport'])->name('admin.report');
Route::get('/admin/report/download', [AdminReportController::class, 'downloadReport'])->name('admin.report.download');

    
Route::get('/', function () {
    return view('welcome'); // Halaman beranda
})->name('beranda');

Route::get('/produk/{kategori}', [ProdukController::class, 'showByCategory'])->name('produk.kategori');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth:admin');
});

// admin
Route::get('/admin', function () {
    return view('admin.dashboard');
});


Route::get('/transaksi', function () {
    return view('admin.transaksi');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



// User
Route::prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('user.dashboard');
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
});

require __DIR__ . '/auth.php';

