<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataDummySeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. DATA KATEGORI (10 Kategori)
        // ==========================================
        $categories = [
            'Alat Tulis', 'Buku & Kertas', 'Tinta & Printer', 'Aksesoris Komputer',
            'Perlengkapan Meja', 'Map & File', 'Jasa Cetak (Print)',
            'Jasa Fotocopy', 'Jasa Jilid', 'Jasa Lainnya',
        ];

        $catIds = [];
        foreach ($categories as $cat) {
            $category = Category::create([
                'nama_kategori' => $cat,
                'slug' => Str::slug($cat),
            ]);
            $catIds[$cat] = $category->id;
        }

        // ==========================================
        // 2. DATA BARANG ATK (20 Item)
        // ==========================================
        $atks = [
            ['kode' => 'ATK-001', 'nama' => 'Kertas HVS A4 80gr Sinar Dunia', 'harga' => 55000, 'stok' => 50, 'cat' => 'Buku & Kertas'],
            ['kode' => 'ATK-002', 'nama' => 'Kertas HVS F4 70gr PaperOne', 'harga' => 60000, 'stok' => 45, 'cat' => 'Buku & Kertas'],
            ['kode' => 'ATK-003', 'nama' => 'Pulpen Standard AE-7 Hitam (1 Pack)', 'harga' => 15000, 'stok' => 100, 'cat' => 'Alat Tulis'],
            ['kode' => 'ATK-004', 'nama' => 'Pulpen Faster C600 Hitam', 'harga' => 3500, 'stok' => 150, 'cat' => 'Alat Tulis'],
            ['kode' => 'ATK-005', 'nama' => 'Pensil 2B Faber Castell', 'harga' => 4000, 'stok' => 200, 'cat' => 'Alat Tulis'],
            ['kode' => 'ATK-006', 'nama' => 'Penghapus Joyko Hitam Besar', 'harga' => 2500, 'stok' => 120, 'cat' => 'Alat Tulis'],
            ['kode' => 'ATK-007', 'nama' => 'Penggaris Besi 30cm Butterfly', 'harga' => 6000, 'stok' => 60, 'cat' => 'Alat Tulis'],
            ['kode' => 'ATK-008', 'nama' => 'Buku Tulis Sinar Dunia 38 Lembar', 'harga' => 3500, 'stok' => 300, 'cat' => 'Buku & Kertas'],
            ['kode' => 'ATK-009', 'nama' => 'Buku Tulis Campus 50 Lembar', 'harga' => 5000, 'stok' => 200, 'cat' => 'Buku & Kertas'],
            ['kode' => 'ATK-010', 'nama' => 'Tinta Epson 664 Hitam Original', 'harga' => 85000, 'stok' => 25, 'cat' => 'Tinta & Printer'],
            ['kode' => 'ATK-011', 'nama' => 'Tinta Epson 664 Warna (Cyan)', 'harga' => 85000, 'stok' => 20, 'cat' => 'Tinta & Printer'],
            ['kode' => 'ATK-012', 'nama' => 'Flashdisk SanDisk 32GB', 'harga' => 75000, 'stok' => 30, 'cat' => 'Aksesoris Komputer'],
            ['kode' => 'ATK-013', 'nama' => 'Mouse Logitech M170 Wireless', 'harga' => 110000, 'stok' => 15, 'cat' => 'Aksesoris Komputer'],
            ['kode' => 'ATK-014', 'nama' => 'Stapler Joyko HD-10', 'harga' => 12000, 'stok' => 40, 'cat' => 'Perlengkapan Meja'],
            ['kode' => 'ATK-015', 'nama' => 'Isi Stapler Joyko No.10', 'harga' => 2500, 'stok' => 150, 'cat' => 'Perlengkapan Meja'],
            ['kode' => 'ATK-016', 'nama' => 'Gunting Joyko Sedang', 'harga' => 8000, 'stok' => 35, 'cat' => 'Perlengkapan Meja'],
            ['kode' => 'ATK-017', 'nama' => 'Lem Kertas Kenko Besar', 'harga' => 6500, 'stok' => 50, 'cat' => 'Perlengkapan Meja'],
            ['kode' => 'ATK-018', 'nama' => 'Map Plastik Clear Sleeve A4', 'harga' => 2000, 'stok' => 250, 'cat' => 'Map & File'],
            ['kode' => 'ATK-019', 'nama' => 'Ordner Bantex Biru F4', 'harga' => 25000, 'stok' => 20, 'cat' => 'Map & File'],
            ['kode' => 'ATK-020', 'nama' => 'Spidol Snowman Whiteboard Hitam', 'harga' => 8500, 'stok' => 80, 'cat' => 'Alat Tulis'],
        ];

        foreach ($atks as $atk) {
            Item::create([
                'category_id' => $catIds[$atk['cat']],
                'type' => 'barang',
                'kode' => $atk['kode'],
                'nama' => $atk['nama'],
                'harga' => $atk['harga'],
                'stok' => $atk['stok'],
            ]);
        }

        // ==========================================
        // 3. DATA JASA LAYANAN (10 Item)
        // ==========================================
        $jasas = [
            ['kode' => 'JS-PR-01', 'nama' => 'Print Hitam Putih A4/F4', 'harga' => 500, 'cat' => 'Jasa Cetak (Print)'],
            ['kode' => 'JS-PR-02', 'nama' => 'Print Warna A4/F4 (Teks)', 'harga' => 1000, 'cat' => 'Jasa Cetak (Print)'],
            ['kode' => 'JS-PR-03', 'nama' => 'Print Warna A4/F4 (Full Gambar)', 'harga' => 2500, 'cat' => 'Jasa Cetak (Print)'],
            ['kode' => 'JS-FC-01', 'nama' => 'Fotocopy Hitam Putih A4/F4', 'harga' => 250, 'cat' => 'Jasa Fotocopy'],
            ['kode' => 'JS-FC-02', 'nama' => 'Fotocopy Bolak Balik A4/F4', 'harga' => 400, 'cat' => 'Jasa Fotocopy'],
            ['kode' => 'JS-JL-01', 'nama' => 'Jilid Lakban Hitam Biasa', 'harga' => 5000, 'cat' => 'Jasa Jilid'],
            ['kode' => 'JS-JL-02', 'nama' => 'Jilid Spiral Kawat/Plastik', 'harga' => 15000, 'cat' => 'Jasa Jilid'],
            ['kode' => 'JS-JL-03', 'nama' => 'Jilid Hardcover (Skripsi)', 'harga' => 40000, 'cat' => 'Jasa Jilid'],
            ['kode' => 'JS-LN-01', 'nama' => 'Laminating KTP / Kartu', 'harga' => 2000, 'cat' => 'Jasa Lainnya'],
            ['kode' => 'JS-LN-02', 'nama' => 'Laminating Dokumen A4/F4', 'harga' => 5000, 'cat' => 'Jasa Lainnya'],
        ];

        foreach ($jasas as $jasa) {
            Item::create([
                'category_id' => $catIds[$jasa['cat']],
                'type' => 'jasa',
                'kode' => $jasa['kode'],
                'nama' => $jasa['nama'],
                'harga' => $jasa['harga'],
                'stok' => null,
            ]);
        }

        // ==========================================
        // 4. GENERATE 60+ TRANSAKSI KASIR DUMMY
        // ==========================================
        // Ambil ID Kasir (asumsi ID 2 sesuai UserSeeder sebelumnya)
        $kasirUser = User::where('role', 'kasir')->first() ?? User::first();
        $allItems = Item::all();
        $now = Carbon::now('Asia/Makassar');

        for ($i = 1; $i <= 65; $i++) {
            // Mundurkan waktu acak antara 0 hari sampai 60 hari yang lalu
            $randomDays = rand(0, 60);
            $randomHours = rand(8, 20); // Jam buka toko 08:00 - 20:00
            $randomMinutes = rand(0, 59);

            $trxDate = $now->copy()->subDays($randomDays)->setTime($randomHours, $randomMinutes, 0);

            // Format Invoice: INV-DDMMYYYY-XXX
            $invoiceNo = 'INV-'.$trxDate->format('dmY').'-'.str_pad($i, 3, '0', STR_PAD_LEFT);

            // Buat kerangka transaksi
            $transaction = Transaction::create([
                'user_id' => $kasirUser->id,
                'invoice_no' => $invoiceNo,
                'total_harga' => 0,
                'bayar' => 0,
                'kembali' => 0,
                'created_at' => $trxDate,
                'updated_at' => $trxDate,
            ]);

            // Pilih 1 hingga 5 item secara acak untuk dibeli
            $itemCount = rand(1, 5);
            $selectedItems = $allItems->random($itemCount);

            $totalHarga = 0;

            foreach ($selectedItems as $item) {
                // Jika jasa, qty bisa banyak (misal fotocopy 1-100 lembar). Jika barang, 1-3 pcs.
                $qty = ($item->type === 'jasa') ? rand(1, 50) : rand(1, 3);
                $subtotal = $item->harga * $qty;
                $totalHarga += $subtotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id,
                    'harga_satuan' => $item->harga,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'created_at' => $trxDate,
                    'updated_at' => $trxDate,
                ]);
            }

            // Simulasi uang pembayaran yang logis (dibulatkan ke pecahan 10rb, 50rb, 100rb terdekat)
            if ($totalHarga < 10000) {
                $bayar = 10000;
            } elseif ($totalHarga < 50000) {
                $bayar = 50000;
            } else {
                $bayar = ceil($totalHarga / 50000) * 50000; // Contoh: 62.000 -> bayar 100.000
            }

            // Update total transaksi
            $transaction->update([
                'total_harga' => $totalHarga,
                'bayar' => $bayar,
                'kembali' => $bayar - $totalHarga,
            ]);
        }
    }
}
