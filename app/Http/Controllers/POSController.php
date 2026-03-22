<?php

namespace App\Http\Controllers;

use App\Http\Requests\POSRequest;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index()
    {
        // Ambil semua item (Barang & Jasa) untuk ditampilkan di layar kasir
        $items = Item::with('category')->get();

        return view('pos.index', compact('items'));
    }

    public function store(POSRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            // 1. Generate Nomor Invoice (Format: INV-DDMMYYYY-001)
            $today = Carbon::now('Asia/Makassar');
            $datePrefix = $today->format('dmY');

            // Hitung transaksi hari ini untuk nomor urut
            $countToday = Transaction::whereDate('created_at', $today->toDateString())->count() + 1;
            $invoiceNo = 'INV-'.$datePrefix.'-'.str_pad($countToday, 3, '0', STR_PAD_LEFT);

            // 2. Simpan ke tabel transactions
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'invoice_no' => $invoiceNo,
                'total_harga' => $validated['total_harga'],
                'bayar' => $validated['bayar'],
                'kembali' => $validated['kembali'],
            ]);

            // 3. Simpan detail & Kurangi stok
            foreach ($validated['items'] as $cartItem) {
                // Simpan detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $cartItem['id'],
                    'harga_satuan' => $cartItem['harga'],
                    'qty' => $cartItem['qty'],
                    'subtotal' => $cartItem['subtotal'],
                ]);

                // Kurangi stok JIKA tipenya barang
                $itemDb = Item::find($cartItem['id']);
                if ($itemDb->type === 'barang' && $itemDb->stok !== null) {
                    if ($itemDb->stok < $cartItem['qty']) {
                        throw new \Exception("Stok {$itemDb->nama} tidak mencukupi!");
                    }
                    $itemDb->decrement('stok', $cartItem['qty']);
                }
            }

            DB::commit();
            session()->flash('success', 'Transaksi berhasil! No. Invoice: '.$invoiceNo);

            return redirect()->route('print.struk', $transaction->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Transaksi gagal: '.$e->getMessage());
        }
    }
}
