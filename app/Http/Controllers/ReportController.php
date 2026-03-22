<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // 1. Menampilkan Halaman Menu Laporan
    public function index()
    {
        return view('reports.index');
    }

    // 2. Laporan Penjualan Harian
    public function harian(Request $request)
    {
        // Default hari ini, atau sesuai inputan user
        $tanggal = $request->input('tanggal', Carbon::now('Asia/Makassar')->toDateString());

        $transactions = Transaction::with('user')
            ->whereDate('created_at', $tanggal)
            ->get();

        $pdf = Pdf::loadView('pdf.reports.harian', compact('transactions', 'tanggal'));

        return $pdf->stream('Laporan_Harian_'.$tanggal.'.pdf');
    }

    // 3. Laporan Stok Barang ATK
    public function stok()
    {
        // Hanya ambil item dengan tipe 'barang'
        $barangs = Item::with('category')->where('type', 'barang')->orderBy('nama')->get();

        $pdf = Pdf::loadView('pdf.reports.stok', compact('barangs'));

        return $pdf->stream('Laporan_Stok_Barang.pdf');
    }

    // 2. Laporan Penjualan Bulanan
    public function bulanan(Request $request)
    {
        // Ambil inputan bulan & tahun, jika kosong gunakan bulan & tahun saat ini
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $transactions = Transaction::with('user')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.reports.bulanan', compact('transactions', 'bulan', 'tahun'));

        return $pdf->stream('Laporan_Bulanan_'.$tahun.'_'.$bulan.'.pdf');
    }

    // 3. Laporan Jasa (Khusus Layanan Fotocopy/Print)
    public function jasa(Request $request)
    {
        // Query ambil detail transaksi yang tipe item-nya adalah 'jasa'
        $query = TransactionDetail::with(['transaction.user', 'item'])
            ->whereHas('item', function ($q) {
                $q->where('type', 'jasa');
            });

        // LOGIKA TANGGAL OPSIONAL: Jika start_date & end_date diisi, terapkan filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('transaction', function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
            });
        }

        $details = $query->get();
        $start = $request->start_date;
        $end = $request->end_date;

        $pdf = Pdf::loadView('pdf.reports.jasa', compact('details', 'start', 'end'));

        return $pdf->stream('Laporan_Penjualan_Jasa.pdf');
    }

    // 4. Laporan Barang (Khusus ATK)
    public function barang(Request $request)
    {
        $query = TransactionDetail::with(['transaction.user', 'item.category'])
            ->whereHas('item', function ($q) {
                $q->where('type', 'barang');
            });

        // LOGIKA TANGGAL OPSIONAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('transaction', function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
            });
        }

        $details = $query->get();
        $start = $request->start_date;
        $end = $request->end_date;

        $pdf = Pdf::loadView('pdf.reports.barang', compact('details', 'start', 'end'));

        return $pdf->stream('Laporan_Penjualan_Barang.pdf');
    }

    // 6. Laporan Transaksi Kasir
    public function transaksi(Request $request)
    {
        $query = Transaction::with('user')->orderBy('created_at', 'asc');

        // LOGIKA TANGGAL OPSIONAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
        }

        $transactions = $query->get();
        $start = $request->start_date;
        $end = $request->end_date;

        $pdf = Pdf::loadView('pdf.reports.transaksi', compact('transactions', 'start', 'end'));

        return $pdf->stream('Laporan_Transaksi_Kasir.pdf');
    }

    // 7. Laporan Pendapatan Keuangan (Dikelompokkan per Tanggal)
    public function pendapatan(Request $request)
    {
        // Query untuk mengelompokkan (GROUP BY) total pendapatan berdasarkan tanggal
        $query = Transaction::selectRaw('DATE(created_at) as tanggal, COUNT(id) as total_transaksi, SUM(total_harga) as total_pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc');

        // LOGIKA TANGGAL OPSIONAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
        }

        $pendapatans = $query->get();
        $start = $request->start_date;
        $end = $request->end_date;

        $pdf = Pdf::loadView('pdf.reports.pendapatan', compact('pendapatans', 'start', 'end'));

        return $pdf->stream('Laporan_Pendapatan.pdf');
    }

    // 8. UPDATE: Laporan Rekap Keseluruhan (Tanggal Opsional)
    public function rekap(Request $request)
    {
        $query = TransactionDetail::with(['transaction.user', 'item.category']);

        // LOGIKA TANGGAL OPSIONAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('transaction', function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
            });
        }

        $details = $query->get();
        $start = $request->start_date;
        $end = $request->end_date;

        $pdf = Pdf::loadView('pdf.reports.rekap', compact('details', 'start', 'end'));
        $pdf->setPaper('A4', 'landscape'); // Landscape karena datanya padat

        return $pdf->stream('Laporan_Rekap_Keseluruhan.pdf');
    }
}
