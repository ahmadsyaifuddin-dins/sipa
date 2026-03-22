@props(['disabled' => false, 'name' => '', 'value' => ''])

<div x-data="{
    // Simpan nilai asli (integer)
    rawValue: '{{ $value }}',
    // Nilai yang akan ditampilkan ke layar
    displayValue: '',

    // Fungsi untuk format angka ke format Rupiah (Ribuan)
    formatNumber(value) {
        let number = value.toString().replace(/\D/g, ''); // Hapus semua selain angka
        return number ? new Intl.NumberFormat('id-ID').format(number) : '';
    },

    // Fungsi saat user mengetik
    updateValue(event) {
        this.rawValue = event.target.value.replace(/\D/g, ''); // Ambil angka aslinya
        this.displayValue = this.formatNumber(this.rawValue); // Format tampilannya
    }
}" x-init="displayValue = formatNumber(rawValue)" class="relative rounded-md shadow-sm">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="text-gray-500 sm:text-sm">Rp</span>
    </div>

    <input type="text" x-model="displayValue" @input="updateValue" {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->except(['name', 'value'])->merge([
            'class' =>
                'block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-100',
        ]) !!}>

    <input type="hidden" name="{{ $name }}" x-model="rawValue">
</div>
