<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detail Transaksi: <span class="text-indigo-600">{{ $transaction->invoice_no }}</span>
            </h2>
            <div class="space-x-2">
                <a href="{{ route('transactions.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
                <a href="{{ route('print.struk', $transaction->id) }}" target="_blank"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Cetak
                    PDF</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 mb-6 bg-white rounded-lg shadow-sm grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nomor Invoice</p>
                    <p class="font-bold text-lg text-gray-900">{{ $transaction->invoice_no }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Transaksi</p>
                    <p class="font-bold text-gray-900">
                        {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y, H:i') }} WITA</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kasir Bertugas</p>
                    <p class="font-bold text-gray-900">{{ $transaction->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Rincian Belanja (Barang & Jasa)</h3>
                </div>
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-16 text-center">No</th>
                            <th scope="col" class="px-6 py-3">Nama Item</th>
                            <th scope="col" class="px-6 py-3 text-center">Harga Satuan</th>
                            <th scope="col" class="px-6 py-3 text-center">Qty</th>
                            <th scope="col" class="px-6 py-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->details as $index => $detail)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $detail->item->nama }}</td>
                                <td class="px-6 py-4 text-center">Rp
                                    {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">{{ $detail->qty }}</td>
                                <td class="px-6 py-4 font-bold text-right">Rp
                                    {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-6 py-4 font-bold text-right text-gray-700">Total Belanja:</td>
                            <td class="px-6 py-4 font-black text-right text-indigo-600 text-lg">Rp
                                {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="px-6 py-2 font-medium text-right text-gray-500">Uang Bayar:</td>
                            <td class="px-6 py-2 font-medium text-right text-gray-900">Rp
                                {{ number_format($transaction->bayar, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="px-6 py-2 font-medium text-right text-gray-500">Kembali:</td>
                            <td class="px-6 py-2 font-medium text-right text-gray-900">Rp
                                {{ number_format($transaction->kembali, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
