@props(['title'])

<x-root-layout :title="$title">
    <div class="min-h-screen bg-gray-100">
        @include('navigation.app')

        <main class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</x-root-layout>
