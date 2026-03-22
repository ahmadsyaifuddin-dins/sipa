<?php

use App\Http\Controllers\AtkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('atk', AtkController::class);
    Route::resource('jasa', JasaController::class);

    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::post('/pos', [POSController::class, 'store'])->name('pos.store');

    Route::get('/print/struk/{id}', [PrintController::class, 'struk'])->name('print.struk');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Menu Utama Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Route Generate PDF (Gunakan GET agar mudah diakses via target="_blank")
    Route::get('/reports/harian', [ReportController::class, 'harian'])->name('reports.harian');
    Route::get('/reports/stok', [ReportController::class, 'stok'])->name('reports.stok');
    Route::get('/reports/rekap', [ReportController::class, 'rekap'])->name('reports.rekap');

    Route::get('/reports/bulanan', [ReportController::class, 'bulanan'])->name('reports.bulanan');
    Route::get('/reports/jasa', [ReportController::class, 'jasa'])->name('reports.jasa');
    Route::get('/reports/barang', [ReportController::class, 'barang'])->name('reports.barang');

    Route::get('/reports/transaksi', [ReportController::class, 'transaksi'])->name('reports.transaksi');
    Route::get('/reports/pendapatan', [ReportController::class, 'pendapatan'])->name('reports.pendapatan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
