<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Layanan: {{ $jasa->nama }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <form action="{{ route('jasa.update', $jasa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('jasa._form', ['jasa' => $jasa])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
