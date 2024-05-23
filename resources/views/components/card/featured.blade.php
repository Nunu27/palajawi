<div class="rounded-lg border border-emerald-500">
    <a href="#" class="h-45 group relative block overflow-hidden rounded-t-md">
        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
            loading="lazy" alt="Photo by Austin Wade"
            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

        <span
            class="absolute left-0 top-3 rounded-r-lg bg-red-500 px-3 py-1.5 text-sm font-semibold uppercase tracking-wider text-white">-50%</span>
    </a>

    <div class="flex items-start justify-between gap-2 rounded-b-lg p-4">
        <div class="flex flex-col">
            <div class="flex flex-col">
                <a href="#"
                    class="font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-lg">Fancy
                    Outfit</a>
                <span>
                    {{-- <button href="{{ route('barang.index') }}"
                    class="mt-2 px-4 py-2 bg-emerald-200 text-emerald-500 rounded-md hover:bg-emerald-500 hover:text-white transition duration-200">buy</button> --}}
                </span>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-gray-600 lg:text-lg">$19.99</span>
            </div>
            <div class="flex flex-row">
                <x-button.a-secondary class="mr-3"
                    href="{{ route('user.transaction.show', 1) }}">Buy</x-button.a-secondary>
                <x-button.a-secondary href="{{ route('cart') }}">Cart</x-button.a-secondary>
            </div>
        </div>

    </div>
</div>
