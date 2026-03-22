<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <x-forms.label for="kode" value="Kode Layanan" required="true" />
        <x-forms.input id="kode" name="kode" type="text" value="{{ old('kode', $jasa->kode ?? '') }}"
            placeholder="Misal: JS-FC-01" required />
        @error('kode')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="nama" value="Nama Layanan" required="true" />
        <x-forms.input id="nama" name="nama" type="text" value="{{ old('nama', $jasa->nama ?? '') }}"
            placeholder="Misal: Fotocopy A4 (Hitam Putih)" required />
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
                    {{ old('category_id', $jasa->category_id ?? '') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </x-forms.dropdown>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="harga" value="Harga per Lembar / Unit" required="true" />
        <x-forms.input-currency id="harga" name="harga" value="{{ old('harga', $jasa->harga ?? '') }}"
            placeholder="0" required />
        @error('harga')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end mt-6 border-t pt-4">
    <a href="{{ route('jasa.index') }}"
        class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
    <button type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Simpan
        Data</button>
</div>
