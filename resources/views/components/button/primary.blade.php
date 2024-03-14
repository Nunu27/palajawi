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
    {{ $attributes->class($classes)->merge(['type' => 'submit', 'class' => 'inline-flex items-center bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700  active:bg-gray-900  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
