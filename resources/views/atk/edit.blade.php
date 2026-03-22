<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Barang: {{ $atk->nama }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <form action="{{ route('atk.update', $atk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('atk._form', ['atk' => $atk])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
