<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Riwayat Transaksi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-16">No</th>
                                <th scope="col" class="px-6 py-3">Tanggal & Waktu</th>
                                <th scope="col" class="px-6 py-3">No. Invoice</th>
                                <th scope="col" class="px-6 py-3">Kasir</th>
                                <th scope="col" class="px-6 py-3 text-right">Total Belanja</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $trx)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $transactions->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($trx->created_at)->translatedFormat('d F Y') }} <br>
                                        <span
                                            class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($trx->created_at)->format('H:i') }}
                                            WITA</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-indigo-600">{{ $trx->invoice_no }}</td>
                                    <td class="px-6 py-4">{{ $trx->user->name }}</td>
                                    <td class="px-6 py-4 font-bold text-right text-gray-900">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('transactions.show', $trx->id) }}"
                                                class="px-3 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">Detail</a>
                                            <a href="{{ route('print.struk', $trx->id) }}" target="_blank"
                                                class="px-3 py-1 text-xs text-white bg-green-500 rounded hover:bg-green-600">Cetak
                                                Struk</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat
                                        transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
