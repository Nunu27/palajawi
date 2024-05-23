<div class="container mx-auto my-6 rounded-lg bg-white pb-6 shadow-md" style="max-width: 500px">
    <div class="flex flex-col items-center justify-center">
        <img src="https://images.unsplash.com/photo-1540553016722-983e48a2cd10?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
            alt="product-image" class="clip-path rounded-t-lg object-cover" style="max-width: 500px">
        <h5 class="my-4 text-xl font-bold">{{ $nama }}</h5>
        <p class="mb-4 text-gray-700">Deskripsi singkat tentang produk.</p>
        <div class="flex flex-row justify-between">
            <span class="mb-4 text-xl font-bold">Rp 100.000</span>
        </div>
        <div>
            <x-button.a-primary class="mr-2" href="{{ route('user.transaction.show', 1) }}">
                Beli
            </x-button.a-primary>
            <x-button.a-secondary class="mr-2">
                Keranjang
            </x-button.a-secondary>
        </div>

    </div>
</div>
