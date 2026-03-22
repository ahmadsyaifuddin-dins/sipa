<div class="mb-4">
    <x-forms.label for="nama_kategori" value="Nama Kategori" required="true" />

    <x-forms.input id="nama_kategori" name="nama_kategori" type="text"
        value="{{ old('nama_kategori', $category->nama_kategori ?? '') }}"
        placeholder="Misal: Alat Tulis, Buku, atau Jasa Print" required />

    @error('nama_kategori')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('categories.index') }}"
        class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
        Batal
    </a>
    <button type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Simpan Data
    </button>
</div>
