<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    // Menampilkan daftar semua transaksi
    public function index()
    {
        // Ambil transaksi beserta nama user (kasir) yang melayani, urutkan dari yang terbaru
        $transactions = Transaction::with('user')->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    // Menampilkan detail item belanja di dalam satu transaksi
    public function show(Transaction $transaction)
    {
        // Load relasi detail belanjaan dan itemnya
        $transaction->load(['details.item', 'user']);

        return view('transactions.show', compact('transaction'));
    }
}
