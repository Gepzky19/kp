<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ProdukController;


Route::get('/transaction/receipt/{name}', [TransactionController::class, 'getReceiptByName']);


Route::get('/transaction/receipt/print/{name}', [TransactionController::class, 'getReceiptByName']);

// Optional: Login tetap boleh ada
// Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']); // hanya admin
});


// Product routes (tanpa middleware)
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Cart routes (tanpa middleware)
Route::post('/cart', [CartController::class, 'addToCart']);

Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/pay', [PaymentController::class, 'pay']);


Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/history', [TransactionController::class, 'userHistory']);
});

Route::get('/admin/report', [AdminReportController::class, 'downloadReport']);

// routes/api.php
Route::get('/produk/{category}', [ProdukController::class, 'apiByCategory']);

Route::middleware('auth:api')->get('/transaction/receipt/{name}', [TransactionController::class, 'getReceiptByName']);
