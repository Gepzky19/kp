<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function showReport(Request $request)
    {
        $adminName = $request->query('admin');
        $admin = Admin::where('name', $adminName)->first();
        if (!$admin) {
            return response()->json(['message' => 'Hanya admin yang dapat mengakses laporan'], 403);
        }

        $transactions = Transaction::orderByDesc('paid_at')->get();

        foreach ($transactions as $tx) {
            if (is_string($tx->products)) {
                $tx->products = json_decode($tx->products, true);
            }
        }

        // Juga kirim logo base64 untuk view normal
        $logoPath = public_path('images/logo/logo.png');
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return view('transactions', [
            'transactions' => $transactions,
            'logo' => $base64Logo
        ]);
    }

    public function downloadReport(Request $request)
    {
        $adminName = $request->query('admin');
        $admin = Admin::where('name', $adminName)->first();
        if (!$admin) {
            return response()->json(['message' => 'Hanya admin yang dapat mengakses laporan'], 403);
        }

        $transactions = Transaction::orderByDesc('paid_at')->get();

        foreach ($transactions as $tx) {
            if (is_string($tx->products)) {
                $tx->products = json_decode($tx->products, true);
            }
        }

        // Siapkan logo base64 untuk PDF
        $logoPath = public_path('images/logo/logo.png');
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = Pdf::loadView('transactions', [
            'transactions' => $transactions,
            'logo' => $base64Logo
        ]);

        return $pdf->download('laporan-transaksi.pdf');
    }
}
