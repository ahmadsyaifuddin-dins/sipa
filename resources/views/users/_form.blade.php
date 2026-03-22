<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <x-forms.label for="name" value="Nama Lengkap" required="true" />
        <x-forms.input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" required />
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="email" value="Alamat Email" required="true" />
        <x-forms.input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}"
            required />
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="role" value="Hak Akses (Role)" required="true" />
        <x-forms.dropdown id="role" name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin (Full
                Akses)</option>
            <option value="kasir" {{ old('role', $user->role ?? '') == 'kasir' ? 'selected' : '' }}>Kasir
                (Operasional)</option>
            <option value="pemilik" {{ old('role', $user->role ?? '') == 'pemilik' ? 'selected' : '' }}>Pemilik
                (Laporan & Dashboard)</option>
        </x-forms.dropdown>
        @error('role')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-forms.label for="password" value="Password" required="{{ isset($user) ? 'false' : 'true' }}" />
        <x-forms.input id="password" name="password" type="password" />
        @if (isset($user))
            <p class="mt-1 text-xs text-gray-500">* Kosongkan jika tidak ingin mengubah password.</p>
        @else
            <p class="mt-1 text-xs text-gray-500">* Minimal 8 karakter.</p>
        @endif
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end mt-6 border-t pt-4">
    <a href="{{ route('users.index') }}"
        class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
    <button type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Simpan
        Akun</button>
</div>
