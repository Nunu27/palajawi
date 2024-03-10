@props(['nama'])

<div class="mt-6 flex w-56 flex-col items-center overflow-hidden rounded-xl shadow-md">
    <img src="https://images.unsplash.com/photo-1540553016722-983e48a2cd10?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
        alt="card-image" class="object-cover" />
    <h5
        class="text-blue-gray-900 mb-2 block p-5 font-sans text-xl font-semibold leading-snug tracking-normal antialiased">
        {{ $nama }}
    </h5>
</div>
