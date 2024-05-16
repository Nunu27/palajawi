@props(['class'])

@php
    $classes = [];

    if (isset($class)) {
        $classes = [$class];

        if (!str_contains($class, 'px')) {
            array_push($classes, 'px-4');
        }
        if (!str_contains($class, 'py')) {
            array_push($classes, 'py-2');
        }
    } else {
        $classes = ['px-4 py-2'];
    }
@endphp

<button
    {{ $attributes->class($classes)->merge(['type' => 'submit', 'class' => 'inline-flex items-center bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700  active:bg-gray-900  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150']) }}
    wire:loading.attr="disabled">
    <svg wire:loading class="h-4 w-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
        </path>
    </svg>
    <div wire:loading.remove class="flex">
        {{ $slot }}
    </div>
</button>
