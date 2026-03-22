<div x-show="sidebarOpen" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
    @click="sidebarOpen = false"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-100 lg:translate-x-0 lg:static lg:inset-0">

    <div class="flex items-center justify-center h-16 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block w-auto h-8 text-indigo-600 fill-current" />
            <span class="text-xl font-black tracking-wider text-gray-800 uppercase">SIPA App</span>
        </a>
    </div>

    <nav class="px-4 mt-5 space-y-1">

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Dashboard
        </a>

        @if (Auth::user()->role === 'admin')
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold tracking-wider text-gray-400 uppercase">Master Data</p>
            </div>
            <a href="{{ route('categories.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                Kategori
            </a>
            <a href="{{ route('atk.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('atk.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                Barang ATK
            </a>
            <a href="{{ route('jasa.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('jasa.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                Jasa Layanan
            </a>
        @endif

        @if (in_array(Auth::user()->role, ['admin', 'kasir']))
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold tracking-wider text-gray-400 uppercase">Transaksi</p>
            </div>
            <a href="{{ route('pos.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pos.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                Kasir (POS)
            </a>
            <a href="{{ route('transactions.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('transactions.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                Riwayat Transaksi
            </a>
        @endif

        <div class="pt-4 pb-1">
            <p class="px-4 text-xs font-bold tracking-wider text-gray-400 uppercase">Laporan</p>
        </div>
        <a href="{{ route('reports.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Cetak Laporan
        </a>

        @if (Auth::user()->role === 'admin')
            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold tracking-wider text-gray-400 uppercase">Pengaturan</p>
            </div>
            <a href="#"
                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                Manajemen User
            </a>
        @endif

    </nav>
</div>
