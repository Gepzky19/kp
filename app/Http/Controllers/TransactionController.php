<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;  // Import Facade PDF

class TransactionController extends Controller
{
    public function getReceiptByName(Request $request, $name)
    {
        // Mencari pengguna berdasarkan nama
        $targetUser = User::where('name', 'like', trim($name))->first();

        if (!$targetUser) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Mendapatkan transaksi berdasarkan user_id
        $transaction = Transaction::where('user_id', $targetUser->id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Menyusun data produk
        $products = json_decode($transaction->products, true);

        // Siapkan logo base64 untuk PDF
        $logoPath = public_path('images/logo/logo.png');
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Render PDF dari view dan kirim data ke view
        $pdf = Pdf::loadView('receipt.print', [
            'logo' => $base64Logo,
            'transaction' => $transaction,
            'products' => $products,
        ]);

        // Mengunduh PDF dengan nama file yang sesuai
        return $pdf->download('struk_transaksi_' . $transaction->id . '.pdf');
    }
    public function downloadReceipt(Request $request, $id)
{
    // Mencari transaksi berdasarkan ID
    $transaction = Transaction::findOrFail($id);

    // Mendapatkan data produk
    $products = json_decode($transaction->products, true);

    // Siapkan logo base64 untuk PDF (opsional)
    $logoPath = public_path('images/logo/logo.png');
    $type = pathinfo($logoPath, PATHINFO_EXTENSION);
    $data = file_get_contents($logoPath);
    $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

    // Render PDF dari view dan kirim data ke view
    $pdf = Pdf::loadView('receipt.print', [
        'logo' => $base64Logo,
        'transaction' => $transaction,
        'products' => $products,
    ]);

    // Mengunduh PDF dengan nama file yang sesuai
    return $pdf->download('struk_transaksi_' . $transaction->id . '.pdf');
}


}
