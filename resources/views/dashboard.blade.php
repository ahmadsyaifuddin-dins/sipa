<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard Utama
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="p-6 mb-6 bg-white border-l-4 border-indigo-500 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-sm text-gray-600">Anda login sebagai <span
                        class="font-bold uppercase text-indigo-600">{{ Auth::user()->role }}</span> di Sistem Penjualan
                    Toko Azizah.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">Pendapatan Hari Ini</p>
                            <h4 class="mt-1 text-2xl font-black text-gray-800">Rp
                                {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">Omset Bulan Ini</p>
                            <h4 class="mt-1 text-2xl font-black text-indigo-600">Rp
                                {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h4>
                        </div>
                        <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">Transaksi Hari Ini</p>
                            <h4 class="mt-1 text-2xl font-black text-gray-800">{{ $transaksiHariIni }} <span
                                    class="text-sm font-medium text-gray-500">Struk</span></h4>
                        </div>
                        <div class="p-3 text-blue-600 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">Total Barang ATK</p>
                            <h4 class="mt-1 text-2xl font-black text-gray-800">{{ $totalBarang }} <span
                                    class="text-sm font-medium text-gray-500">Item</span></h4>
                        </div>
                        <div class="p-3 text-amber-600 bg-amber-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm lg:col-span-2">
                    <h3 class="mb-4 text-sm font-bold tracking-wider text-gray-500 uppercase">Grafik Pendapatan 7 Hari
                        Terakhir</h3>
                    <div class="relative h-72">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                    <h3 class="mb-4 text-sm font-bold tracking-wider text-gray-500 uppercase flex items-center gap-2">
                        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        Peringatan Stok Menipis
                    </h3>

                    @if ($stokMenipis->isEmpty())
                        <div class="flex flex-col items-center justify-center h-48 text-gray-400">
                            <svg class="w-12 h-12 mb-2 text-green-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium">Stok barang aman.</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-100">
                            @foreach ($stokMenipis as $item)
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-800">{{ $item->nama }}</span>
                                            <span class="text-xs text-gray-500">{{ $item->kode }}</span>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-md">
                                            Sisa: {{ $item->stok }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('atk.index') }}"
                                class="block w-full py-2 mt-4 text-xs font-bold text-center text-indigo-600 transition bg-indigo-50 rounded hover:bg-indigo-100">Kelola
                                Barang &rarr;</a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            // Ambil data dari Controller
            const labels = @json($chartDates);
            const data = @json($chartTotals);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data,
                        borderColor: '#4f46e5', // Warna Indigo-600
                        backgroundColor: 'rgba(79, 70, 229, 0.1)', // Transparan fill
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.3 // Garis melengkung (smooth)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    // Format tooltip jadi Rupiah
                                    label += new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    }).format(context.parsed.y);
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    if (value >= 1000000) return 'Rp ' + (value / 1000000) + ' Jt';
                                    if (value >= 1000) return 'Rp ' + (value / 1000) + ' Rb';
                                    return 'Rp ' + value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
