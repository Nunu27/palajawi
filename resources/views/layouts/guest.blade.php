@props(['title'])

<x-root-layout :title="$title">
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="{{ route('home') }}"
                class="flex items-center gap-5 whitespace-nowrap text-4xl font-semibold uppercase">
                <x-logo class="h-20 w-20 fill-current text-gray-500" />
                Palajawi
            </a>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</x-root-layout>
