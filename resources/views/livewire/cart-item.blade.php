<?php

use Livewire\Volt\Component;
use App\Models\Keranjang;
use Livewire\Attributes\Url;

new class extends Component {
    public $id;
    public $gambar;
    public $nama;
    public $kategori;
    public $stok;
    public $harga;
    public $jumlah;

    public function mount($id, $gambar, $nama, $kategori, $stok, $harga, $jumlah)
    {
        $this->id = $id;
        $this->gambar = $gambar;
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->stok = $stok;
        $this->harga = $harga;
        $this->jumlah = $jumlah;
    }

    public function increment()
    {
        if ($this->jumlah < $this->stok) {
            $this->jumlah++;
            $this->dispatch('cart-update', id: $this->id, jumlah: $this->jumlah);
            Keranjang::find($this->id)->update([
                'jumlah' => $this->jumlah,
            ]);
        }
    }

    public function decrement()
    {
        if ($this->jumlah > 1) {
            $this->jumlah--;
            $this->dispatch('cart-update', id: $this->id, jumlah: $this->jumlah);
            Keranjang::find($this->id)->update([
                'jumlah' => $this->jumlah,
            ]);
        }
    }

    public function delete()
    {
        Keranjang::find($this->id)->delete();
        $this->dispatch('cart-delete', id: $this->id);
    }
}; ?>

<div class="flex flex-wrap items-center gap-x-4 overflow-hidden rounded-lg border sm:gap-y-4 lg:gap-6">
    <input type="checkbox" class="m-5 ml-10" x-model="checkoutList" value="{{ $id }}">
    <div class="sm:h-30 group relative block h-48 w-32 overflow-hidden bg-gray-100 sm:w-40">
        <img src="{{ $gambar }}" loading="lazy" alt="Photo by Rachit Tank" loading="lazy" alt="{{ $nama }}"
            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
    </div>

    <div class="flex flex-1 flex-col justify-between py-4">
        <div>
            <div
                class="mb-1 inline-block text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl">
                {{ $nama }}</div>
            <span class="block text-gray-500">Kategory: {{ $kategori }}</span>
            <span>Rp. {{ number_format($harga, 0, ',', '.') }}</span>
        </div>
    </div>

    <div
        class="flex w-full flex-col items-end justify-between border-t p-4 sm:w-auto sm:border-none sm:pl-0 lg:p-6 lg:pl-0">
        <div class="flex items-start gap-2">
            <button wire:click='decrement' class="w-14 rounded-full border">-</button>
            <div>{{ $jumlah }}</div>
            <button wire:click='increment' class="w-14 rounded-full border">+</button>
            <span class="ml-10 block font-bold text-gray-800 md:text-lg">Rp.
                {{ number_format($harga * $jumlah, 0, ',', '.') }}</span>
        </div>
        <button wire:click='delete'>
            <x-gmdi-delete class="h-8 text-red-500" />
        </button>
    </div>
</div>
