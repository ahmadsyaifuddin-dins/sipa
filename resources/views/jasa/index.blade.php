<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Manajemen Jasa Layanan</h2>
            <a href="{{ route('jasa.create') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">+ Tambah
                Layanan</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}</div>
            @endif

            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-16">No</th>
                                <th scope="col" class="px-6 py-3">Kode</th>
                                <th scope="col" class="px-6 py-3">Nama Layanan</th>
                                <th scope="col" class="px-6 py-3">Kategori</th>
                                <th scope="col" class="px-6 py-3">Harga / Lembar</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jasas as $index => $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $jasas->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $item->kode }}</td>
                                    <td class="px-6 py-4">{{ $item->nama }}</td>
                                    <td class="px-6 py-4">{{ $item->category->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('jasa.edit', $item->id) }}"
                                                class="px-3 py-1 text-xs text-white bg-amber-500 rounded hover:bg-amber-600">Edit</a>
                                            <form action="{{ route('jasa.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data Jasa
                                        Layanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">{{ $jasas->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
