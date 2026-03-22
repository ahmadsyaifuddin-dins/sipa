<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function struk($id)
    {
        // Ambil data transaksi beserta relasi detail dan itemnya
        $transaction = Transaction::with(['details.item', 'user'])->findOrFail($id);

        // Load view PDF
        $pdf = Pdf::loadView('pdf.struk', compact('transaction'));

        // Atur ukuran kertas (Untuk struk biasanya ukuran kustom atau A5, kita pakai A5 portrait dulu)
        $pdf->setPaper('A5', 'portrait');

        // STREAM, bukan download (Aturan 5)
        return $pdf->stream('Struk_'.$transaction->invoice_no.'.pdf');
    }
}
