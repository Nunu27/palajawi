@props(['nama'])

<div class="mt-6 w-56 overflow-hidden rounded-xl shadow-md">
    <img src="https://images.unsplash.com/photo-1540553016722-983e48a2cd10?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
        alt="card-image" class="object-cover" />
    <div class="p-6">
        <h5
            class="text-blue-gray-900 mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal antialiased">
            {{ $nama }}
        </h5>
    </div>
    <div class="p-6 pt-0">
        <button
            class="select-none rounded-lg px-6 py-3 text-center align-middle font-sans text-xs font-bold uppercase shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button">
            Beli
        </button>
    </div>
</div>
