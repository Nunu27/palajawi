<?php

use App\Models\Barang;
use App\Models\Keranjang;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.app')] #[Title('Detail')] class extends Component {
    use Toastable;

    public $id;
    public $barang;
    public $cart;
    public $count = 1;

    public function mount()
    {
        $this->id = Route::current()->parameter('id');
        $this->barang = Barang::find($this->id);
        $user = request()->user();
        if (isset($user)) {
            $this->cart = Keranjang::where('id_user', $user->id)
                ->where('id_barang', $this->id)
                ->first();
        }
        if ($this->cart) {
            $this->count = $this->cart->jumlah;
        }
    }

    public function increment()
    {
        if ($this->count < $this->barang->stok) {
            $this->count++;
        }
    }

    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
        }
    }

    public function addToCart()
    {
        if (!request()->user()) {
            return;
        }
        if (isset($this->cart)) {
            $this->cart->castAndUpdate([
                'jumlah' => $this->count,
            ]);
            $this->success('Keranjang berhasil diupdate');
        } else {
            $this->cart = Keranjang::castAndCreate([
                'id_user' => request()->user()->id,
                'id_barang' => $this->id,
                'jumlah' => $this->count,
            ]);
            $this->success('Berhasil ditambahkan ke keranjang');
        }
    }

    public function buy()
    {
        if (!request()->user()) {
            return;
        }
        if (isset($this->cart)) {
            $this->cart->castAndUpdate([
                'jumlah' => $this->count,
            ]);
        } else {
            $this->cart = Keranjang::castAndCreate([
                'id_user' => request()->user()->id,
                'id_barang' => $this->id,
                'jumlah' => $this->count,
            ]);
        }
        $this->redirect(route('confirmation') . '?ids=' . $this->cart->id, navigate: true);
    }
}; ?>

<div>
    <div class="mb-2 flex gap-10 bg-white p-4">
        <img class="float-left block h-80 w-80 rounded border object-cover" src="{{ $barang->cover }}"
            alt="{{ $barang->nama }}" />
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <p class="text-left text-lg font-semibold text-black">{{ $barang->nama }}</p>
                    <p class="text-left text-lg font-thin text-gray-500">{{ $barang->kategori->nama }}</p>
                    <p class="mt-3 text-left text-3xl font-extrabold text-black">Rp.
                        {{ number_format($barang->harga, 0, ',', '.') }}</p>
                </div>
                <div>
                    <div class="flex items-center justify-center">
                        <button wire:click='decrement'
                            class="rounded-md border border-black px-4 py-1 text-sm font-semibold text-black hover:border-transparent hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">-</button>
                        <p class="text-sm-center w-10 rounded-md px-4 py-1 font-semibold text-black">
                            {{ $count }}</p>
                        <button wire:click='increment'
                            class="rounded-md border border-black px-4 py-1 text-sm font-semibold text-black hover:border-transparent hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">+</button>
                        <span class="ml-4">Stok: {{ $barang->stok }}</span class="ml-4">
                    </div>
                    <div class="justify-rigt flex">
                        <button wire:click='addToCart'
                            class="mr-2 mt-3 rounded-md border border-black px-4 py-1 text-sm font-semibold text-black hover:border-transparent hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Keranjang</button>
                        <button wire:click='buy'
                            class="mt-3 rounded-md border border-black px-4 py-1 text-sm font-semibold text-black hover:border-transparent hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Beli</button>
                    </div>
                </div>
            </div>
            <div>
                <p class="mt-5 border-b border-gray-500 text-left text-lg font-thin text-black">Detail</p>
                <p class="font-medium text-black">
                    {{ $barang->deskripsi }}
                </p>
            </div>
        </div>
    </div>

    <section class="min-w-screen flex items-center justify-center bg-white py-20">
        <div class="bg-white px-16">
            <div class="container mx-auto flex flex-col items-start lg:items-center">

                <h2
                    class="relative flex w-full max-w-3xl items-start justify-start text-5xl font-bold lg:justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="absolute right-0 -mr-16 -mt-2 hidden h-12 w-12 text-gray-200 lg:inline-block"
                        viewBox="0 0 975.036 975.036">
                        <path
                            d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                        </path>
                    </svg>
                    Ulasan
                </h2>
                <div class="mt-6 block h-0.5 w-full max-w-lg rounded-full bg-purple-100" data-primary="purple-600">
                </div>

                <div class="mb-4 mt-12 w-full items-center justify-center lg:flex">
                    <div class="mb-12 flex h-auto w-full flex-col items-start justify-start lg:mb-0 lg:w-1/3">
                        <x-item-ulasan username="Rapli"
                            avatar="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80"
                            rating="4.8"
                            ulasan="'  Saya sangat senang dengan produk ini! Sangat berkualitas dan sesuai dengan ekspektasi saya. Saya pasti akan kembali lagi untuk membeli produk lainnya '" />
                    </div>

                    <div class="mb-12 flex h-auto w-full flex-col items-start justify-start lg:mb-0 lg:w-1/3">
                        <x-item-ulasan username="Wisnu"
                            avatar="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80"
                            rating="4.8"
                            ulasan="'  Saya sangat senang dengan produk ini! Sangat berkualitas dan sesuai dengan ekspektasi saya. Saya pasti akan kembali lagi untuk membeli produk lainnya '" />
                    </div>

                    <div class="mb-12 flex h-auto w-full flex-col items-start justify-start lg:mb-0 lg:w-1/3">
                        <x-item-ulasan username="Bagas"
                            avatar="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80"
                            rating="4.8"
                            ulasan="'  Saya sangat senang dengan produk ini! Sangat berkualitas dan sesuai dengan ekspektasi saya. Saya pasti akan kembali lagi untuk membeli produk lainnya '" />
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div
        class="mx-auto max-w-full space-y-2 bg-black px-8 py-8 shadow-lg sm:flex sm:items-center sm:space-x-6 sm:space-y-0 sm:py-4">
        <div class="space-y-8 text-left sm:text-center">
            <p class="mb-2 text-lg font-bold text-white">Apakah Anda puas dengan produk Anda?</p>
            <div class="relative">
                <input type="range" min="0" max="100" value="50" step="any"
                    class="z-30 flex h-full w-full cursor-pointer appearance-none items-center bg-transparent [&::-moz-range-progress]:rounded-full [&::-moz-range-progress]:bg-blue-400 [&::-moz-range-thumb]:h-2.5 [&::-moz-range-thumb]:w-2.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-0 [&::-moz-range-thumb]:bg-blue-600 [&::-moz-range-track]:rounded-full [&::-moz-range-track]:bg-neutral-200 [&::-ms-fill-lower]:rounded-full [&::-ms-fill-lower]:bg-blue-400 [&::-ms-thumb]:h-2.5 [&::-ms-thumb]:w-2.5 [&::-ms-thumb]:appearance-none [&::-ms-thumb]:rounded-full [&::-ms-thumb]:border-0 [&::-ms-thumb]:bg-blue-600 [&::-ms-track]:rounded-full [&::-ms-track]:bg-neutral-200 [&::-webkit-slider-runnable-track]:overflow-hidden [&::-webkit-slider-runnable-track]:rounded-full [&::-webkit-slider-runnable-track]:bg-neutral-200 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-0 [&::-webkit-slider-thumb]:bg-blue-600 [&::-webkit-slider-thumb]:shadow-[-999px_0px_0px_990px_#4e97ff]">
                <div class="absolute bottom-0 left-0 text-lg font-bold text-white transition-all">
                    <span class="animate-slide rounded-md bg-blue-600 px-2 py-1">1.0</span>
                </div>
                <div class="absolute bottom-0 right-0 text-lg font-bold text-white transition-all">
                    <span class="animate-slide rounded-md bg-blue-600 px-2 py-1">5.0</span>
                </div>
            </div>
        </div>
        <div class="text-center sm:text-center">
            <p class="mb-2 text-lg font-bold text-white">Berikan komentar tentang produk anda</p>
        </div>
        <div class="mx-auto w-full">
            <input type="text" placeholder="Isi ulasan anda"
                class="ring-offset-background flex h-10 w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
        </div>
    </div>
</div>
