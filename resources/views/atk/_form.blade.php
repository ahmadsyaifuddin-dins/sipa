<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <x-forms.label for="kode" value="Kode Barang (SKU)" required="true" />
        <x-forms.input id="kode" name="kode" type="text" value="{{ old('kode', $atk->kode ?? '') }}"
            placeholder="Misal: ATK-001" required />
        @error('kode')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="nama" value="Nama Barang" required="true" />
        <x-forms.input id="nama" name="nama" type="text" value="{{ old('nama', $atk->nama ?? '') }}"
            placeholder="Misal: Buku Tulis Sinar Dunia" required />
        @error('nama')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="category_id" value="Kategori" required="true" />
        <x-forms.dropdown id="category_id" name="category_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ old('category_id', $atk->category_id ?? '') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </x-forms.dropdown>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="harga" value="Harga Satuan" required="true" />
        <x-forms.input-currency id="harga" name="harga" value="{{ old('harga', $atk->harga ?? '') }}"
            placeholder="0" required />
        @error('harga')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="stok" value="Stok Awal" required="true" />
        <x-forms.input id="stok" name="stok" type="number" value="{{ old('stok', $atk->stok ?? 0) }}"
            min="0" required />
        @error('stok')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="foto" value="Foto Barang (Opsional)" />
        <x-forms.upload-gambar id="foto" name="foto" />
        @error('foto')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if (isset($atk) && $atk->foto)
            <div class="mt-2">
                <p class="mb-1 text-xs text-gray-500">Foto saat ini:</p>
                <img src="{{ asset('uploads/' . $atk->foto) }}" alt="Foto Barang"
                    class="object-cover w-24 h-24 border rounded-md shadow-sm">
            </div>
        @endif
    </div>
</div>

<div class="flex items-center justify-end mt-6 border-t pt-4">
    <a href="{{ route('atk.index') }}"
        class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
    <button type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Simpan
        Data</button>
</div>
