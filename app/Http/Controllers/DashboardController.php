<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Set zona waktu sesuai aturan
        $today = Carbon::now('Asia/Makassar')->toDateString();
        $thisMonth = Carbon::now('Asia/Makassar')->format('m');
        $thisYear = Carbon::now('Asia/Makassar')->format('Y');

        // 1. Kalkulasi Widget Statistik (Stat Cards)
        $pendapatanHariIni = Transaction::whereDate('created_at', $today)->sum('total_harga');

        $pendapatanBulanIni = Transaction::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->sum('total_harga');

        $transaksiHariIni = Transaction::whereDate('created_at', $today)->count();

        $totalBarang = Item::where('type', 'barang')->count();

        // 2. Kalkulasi Data Grafik (7 Hari Terakhir)
        $chartDates = [];
        $chartTotals = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now('Asia/Makassar')->subDays($i)->toDateString();
            // Format tanggal untuk label di grafik (Misal: 15 Mar)
            $chartDates[] = Carbon::parse($date)->translatedFormat('d M');
            // Total pendapatan per hari tersebut
            $chartTotals[] = Transaction::whereDate('created_at', $date)->sum('total_harga');
        }

        // 3. Peringatan Stok Menipis (Maksimal 5 item yang stoknya <= 10)
        $stokMenipis = Item::where('type', 'barang')
            ->whereNotNull('stok')
            ->where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'transaksiHariIni',
            'totalBarang',
            'chartDates',
            'chartTotals',
            'stokMenipis'
        ));
    }
}
