<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Cetak Laporan Sistem
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">1. Laporan Harian</h3>
                    <p class="mb-4 text-sm text-gray-500">Rekapitulasi total pendapatan per hari tertentu.</p>
                    <form action="{{ route('reports.harian') }}" method="GET" target="_blank">
                        <div class="mb-4">
                            <x-forms.label value="Pilih Tanggal" />
                            <x-forms.input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required />
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">2. Laporan Bulanan</h3>
                    <p class="mb-4 text-sm text-gray-500">Rekapitulasi total pendapatan per bulan tertentu.</p>
                    <form action="{{ route('reports.bulanan') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Bulan" />
                                <x-forms.dropdown name="bulan" required>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                            {{ date('m') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                        </option>
                                    @endfor
                                </x-forms.dropdown>
                            </div>
                            <div>
                                <x-forms.label value="Tahun" />
                                <x-forms.input type="number" name="tahun" value="{{ date('Y') }}" required />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">3. Laporan Jasa</h3>
                    <p class="mb-4 text-sm text-gray-500">Rincian layanan jasa yang terjual (Opsional: Filter Tanggal).
                    </p>
                    <form action="{{ route('reports.jasa') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Dari Tgl" />
                                <x-forms.input type="date" name="start_date" />
                            </div>
                            <div>
                                <x-forms.label value="Sampai Tgl" />
                                <x-forms.input type="date" name="end_date" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">4. Laporan Barang ATK</h3>
                    <p class="mb-4 text-sm text-gray-500">Rincian barang ATK yang terjual (Opsional: Filter Tanggal).
                    </p>
                    <form action="{{ route('reports.barang') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Dari Tgl" />
                                <x-forms.input type="date" name="start_date" />
                            </div>
                            <div>
                                <x-forms.label value="Sampai Tgl" />
                                <x-forms.input type="date" name="end_date" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div
                    class="flex flex-col justify-between p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-800">5. Laporan Stok Barang</h3>
                        <p class="mb-4 text-sm text-gray-500">Menampilkan sisa kuantitas barang ATK di toko secara
                            real-time.</p>
                    </div>
                    <a href="{{ route('reports.stok') }}" target="_blank"
                        class="block w-full px-4 py-2 mt-4 text-sm font-bold text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                        Preview PDF
                    </a>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">6. Laporan Transaksi</h3>
                    <p class="mb-4 text-sm text-gray-500">Histori invoice kasir (Opsional: Filter Tanggal).</p>
                    <form action="{{ route('reports.transaksi') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Dari Tgl" />
                                <x-forms.input type="date" name="start_date" />
                            </div>
                            <div>
                                <x-forms.label value="Sampai Tgl" />
                                <x-forms.input type="date" name="end_date" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">7. Laporan Pendapatan</h3>
                    <p class="mb-4 text-sm text-gray-500">Omset harian yang dikelompokkan (Opsional: Filter Tanggal).
                    </p>
                    <form action="{{ route('reports.pendapatan') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Dari Tgl" />
                                <x-forms.input type="date" name="start_date" />
                            </div>
                            <div>
                                <x-forms.label value="Sampai Tgl" />
                                <x-forms.input type="date" name="end_date" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

                <div class="p-6 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">8. Rekap Keseluruhan</h3>
                    <p class="mb-4 text-sm text-gray-500">Detail seluruh transaksi barang & jasa (Opsional: Filter
                        Tanggal).</p>
                    <form action="{{ route('reports.rekap') }}" method="GET" target="_blank">
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div>
                                <x-forms.label value="Dari Tgl" />
                                <x-forms.input type="date" name="start_date" />
                            </div>
                            <div>
                                <x-forms.label value="Sampai Tgl" />
                                <x-forms.input type="date" name="end_date" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Preview PDF
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
