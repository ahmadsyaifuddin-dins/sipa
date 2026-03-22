@props(['disabled' => false])

<div class="relative rounded-md shadow-sm">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="text-gray-500 sm:text-sm">Rp</span>
    </div>
    <input type="number" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-100',
    ]) !!}>
</div>
