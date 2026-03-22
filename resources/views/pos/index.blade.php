<x-app-layout>
    <div x-data="posApp()" class="flex h-[calc(100vh-4rem)] overflow-hidden">

        <div class="flex flex-col flex-1 bg-white border-r border-gray-200">
            <div class="p-4 border-b border-gray-200 shadow-sm">
                <input type="text" x-model="searchQuery" placeholder="Cari barang atau jasa..."
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex-1 p-4 overflow-y-auto bg-gray-50">
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">{{ session('error') }}</div>
                @endif

                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    <template x-for="item in filteredItems" :key="item.id">
                        <div @click="addToCart(item)"
                            class="relative cursor-pointer transition hover:shadow-lg bg-white border border-gray-200 rounded-lg overflow-hidden flex flex-col h-48">
                            <div class="absolute mt-2 ml-2">
                                <span class="px-2 py-1 text-[10px] font-bold text-white rounded shadow"
                                    :class="item.type === 'jasa' ? 'bg-amber-500' : 'bg-indigo-500'"
                                    x-text="item.type.toUpperCase()">
                                </span>
                            </div>
                            <div class="flex items-center justify-center h-24 bg-gray-100 border-b">
                                <template x-if="item.foto">
                                    <img :src="'/uploads/' + item.foto" class="object-cover w-full h-full">
                                </template>
                                <template x-if="!item.foto">
                                    <span class="text-xs text-gray-400"
                                        x-text="item.type === 'jasa' ? 'Jasa Layanan' : 'Tanpa Foto'"></span>
                                </template>
                            </div>
                            <div class="flex flex-col p-2 text-center">
                                <p class="text-xs text-gray-500 truncate" x-text="item.kode"></p>
                                <p class="text-sm font-bold text-gray-800 line-clamp-2 leading-tight"
                                    x-text="item.nama"></p>
                                <p class="mt-1 text-sm font-black text-indigo-600" x-text="formatRupiah(item.harga)">
                                </p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-96 bg-white shadow-l">
            <div class="p-4 text-white bg-indigo-800 shadow-md">
                <h2 class="text-lg font-bold">Keranjang Belanja</h2>
            </div>

            <div class="flex-1 p-2 overflow-y-auto">
                <template x-if="cart.length === 0">
                    <div class="flex flex-col items-center justify-center h-full text-gray-400">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p>Keranjang masih kosong</p>
                    </div>
                </template>

                <ul class="space-y-2">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <li class="p-3 bg-gray-50 border border-gray-200 rounded-md">
                            <div class="flex justify-between font-medium text-gray-800">
                                <span x-text="item.nama"></span>
                                <button @click="removeFromCart(index)"
                                    class="text-red-500 hover:text-red-700">✖</button>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="flex items-center space-x-2">
                                    <button type="button" @click="decreaseQty(index)"
                                        class="w-6 h-6 text-white bg-gray-400 rounded-full hover:bg-gray-600">-</button>
                                    <input type="number" x-model.number="item.qty" min="1"
                                        class="w-16 p-1 text-center border-gray-300 rounded-md" @change="calculateCart">
                                    <button type="button" @click="increaseQty(index)"
                                        class="w-6 h-6 text-white bg-indigo-500 rounded-full hover:bg-indigo-600">+</button>
                                </div>
                                <span class="font-bold text-gray-700"
                                    x-text="formatRupiah(item.harga * item.qty)"></span>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>

            <div class="p-4 bg-gray-100 border-t border-gray-300">
                <form action="{{ route('pos.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="total_harga" :value="totalHarga">
                    <input type="hidden" name="kembali" :value="kembali">

                    <template x-for="(item, index) in cart" :key="index">
                        <div>
                            <input type="hidden" :name="'items[' + index + '][id]'" :value="item.id">
                            <input type="hidden" :name="'items[' + index + '][qty]'" :value="item.qty">
                            <input type="hidden" :name="'items[' + index + '][harga]'" :value="item.harga">
                            <input type="hidden" :name="'items[' + index + '][subtotal]'"
                                :value="item.harga * item.qty">
                        </div>
                    </template>

                    <div class="flex justify-between mb-2 text-xl font-black text-gray-800">
                        <span>Total:</span>
                        <span x-text="formatRupiah(totalHarga)"></span>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Uang Bayar</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><span
                                    class="text-gray-500 sm:text-sm">Rp</span></div>
                            <input type="text" x-model="displayBayar" @input="updateBayar"
                                class="block w-full pl-10 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 text-lg font-bold text-right"
                                placeholder="0">
                            <input type="hidden" name="bayar" :value="uangBayar">
                        </div>
                        @error('bayar')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between p-2 mb-4 bg-white border border-gray-200 rounded text-md">
                        <span class="text-gray-500">Kembalian:</span>
                        <span class="font-bold" :class="kembali < 0 ? 'text-red-500' : 'text-green-600'"
                            x-text="formatRupiah(kembali < 0 ? 0 : kembali)"></span>
                    </div>

                    <button type="submit" :disabled="cart.length === 0 || uangBayar < totalHarga"
                        class="w-full py-3 text-lg font-bold text-white transition rounded-md shadow-lg"
                        :class="(cart.length === 0 || uangBayar < totalHarga) ? 'bg-gray-400 cursor-not-allowed' :
                        'bg-green-600 hover:bg-green-700'">
                        PROSES PEMBAYARAN
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function posApp() {
            return {
                // Parse data items dari Controller PHP ke Javascript Array
                allItems: @json($items),
                searchQuery: '',
                cart: [],
                totalHarga: 0,
                uangBayar: 0,
                displayBayar: '',
                kembali: 0,

                // Computed property untuk filter pencarian
                get filteredItems() {
                    if (this.searchQuery === '') return this.allItems;
                    return this.allItems.filter(item => {
                        return item.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            item.kode.toLowerCase().includes(this.searchQuery.toLowerCase());
                    });
                },

                addToCart(item) {
                    // Cek apakah item sudah ada di keranjang
                    let existingItem = this.cart.find(i => i.id === item.id);
                    if (existingItem) {
                        existingItem.qty += 1;
                    } else {
                        // Push copy dari item ke cart
                        this.cart.push({
                            id: item.id,
                            nama: item.nama,
                            harga: item.harga,
                            qty: 1
                        });
                    }
                    this.calculateCart();
                },

                removeFromCart(index) {
                    this.cart.splice(index, 1);
                    this.calculateCart();
                },

                increaseQty(index) {
                    this.cart[index].qty++;
                    this.calculateCart();
                },

                decreaseQty(index) {
                    if (this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                        this.calculateCart();
                    }
                },

                calculateCart() {
                    this.totalHarga = this.cart.reduce((total, item) => total + (item.harga * item.qty), 0);
                    this.calculateKembali();
                },

                updateBayar(event) {
                    // Hapus karakter non-angka
                    let raw = event.target.value.replace(/\D/g, '');
                    this.uangBayar = raw === '' ? 0 : parseInt(raw);
                    this.displayBayar = raw ? new Intl.NumberFormat('id-ID').format(raw) : '';
                    this.calculateKembali();
                },

                calculateKembali() {
                    this.kembali = this.uangBayar - this.totalHarga;
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
</x-app-layout>
