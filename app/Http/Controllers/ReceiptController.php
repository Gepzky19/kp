<?php
// File: app/Http/Controllers/ReceiptController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class ReceiptController extends Controller
{
    public function printReceipt($nama)
    {
        // Cari transaksi berdasarkan nama pembeli yang ada di kolom 'name'
        $transaction = Transaction::where('name', $nama)->firstOrFail();

        // Generate view untuk struk transaksi
        $pdf = PDF::loadView('receipt.print', compact('transaction'));

        // Kembalikan PDF untuk diunduh atau dilihat
        return $pdf->download('struk_transaksi_' . $nama . '.pdf');
    }
}

