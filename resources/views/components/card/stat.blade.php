@props(['name', 'value', 'icon', 'info', 'diff'])

@php
    if (isset($diff) && $diff == 0) {
        unset($diff);
    }
@endphp

<div class="flex items-center justify-between rounded-md border bg-white p-4">
    <div>
        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500">
            {{ $name }}
        </h6>
        <span class="text-xl font-semibold">
            {{ $value }}
        </span>
        @isset($diff)
            <span
                class="{{ $diff > 0 ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100' }} ml-2 inline-block rounded-md px-1 py-px text-xs">
                {{ ($diff > 0 ? '+' : '') . $diff }}%
            </span>
        @endisset
    </div>
    <div>
        @svg($icon, 'h-12 text-gray-300')
    </div>
</div>
