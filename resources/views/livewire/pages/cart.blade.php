<?php

use App\Models\Barang;
use App\Models\Keranjang;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;
use Livewire\Attributes\On;

new #[Layout('layouts.app')] #[Title('Keranjang')] class extends Component {
    use Toastable;

    public $user;
    public $keranjang;
    public $checkoutList = [];

    public function mount()
    {
        $this->user = request()->user();
        $this->keranjang = Keranjang::where('id_user', $this->user->id)
            ->with(['barang', 'barang.kategori'])
            ->get()
            ->toArray();
    }

    #[On('cart-update')]
    public function updateCart($id, $jumlah)
    {
        if (($key = array_search($id, array_column($this->keranjang, 'id'))) !== false) {
            $this->keranjang[$key]['jumlah'] = $jumlah;
        }
    }

    #[On('cart-delete')]
    public function deleteCart($id)
    {
        if (($key = array_search($id, array_column($this->keranjang, 'id'))) !== false) {
            array_splice($this->keranjang, $key, 1);
        }
        if (($key = array_search($id, $this->checkoutList)) !== false) {
            array_splice($this->checkoutList, $key, 1);
        }
    }

    public function checkout()
    {
    }
}; ?>

<div class="bg-white py-6 sm:py-8 lg:py-12" x-data="{
    keranjang: $wire.entangle('keranjang'),
    checkoutList: $persist($wire.entangle('checkoutList'))
}" x-init="checkoutList = keranjang.filter((item) => checkoutList.includes(item.id)).map(({ id }) => id)">
    <div class="mx-auto max-w-screen-lg px-4 md:px-8">
        <div class="mb-6 sm:mb-10 lg:mb-16">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Keranjang</h2>
        </div>

        <div class="mb-6 flex flex-col gap-4 sm:mb-8 md:gap-6">
            <!-- product - start -->
            @foreach ($keranjang as $item)
                <livewire:cart-item :key="$item['id']" :id="$item['id']" :gambar="$item['barang']['cover']" :nama="$item['barang']['nama']"
                    :kategori="$item['barang']['kategori']['nama']" :stok="$item['barang']['stok']" :harga="$item['barang']['harga']" :jumlah="$item['jumlah']" />
            @endforeach
            <!-- product - end -->
        </div>

        <!-- totals - start -->
        <div class="flex flex-col items-end gap-4">
            <div class="w-full rounded-lg bg-gray-100 p-4 sm:max-w-xs">
                <div class="flex items-start justify-between gap-4 text-gray-800">
                    <span class="text-lg font-bold">Total Bayar</span>
                    <span class="flex flex-col items-end">
                        <span class="text-lg font-bold"
                            x-text="formatNumber(keranjang.reduce((c, n) => checkoutList.includes(n.id.toString()) ? c + n.barang.harga * n.jumlah : c, 0) ?? 0, {prefix: 'Rp. ', required: false})"></span>
                    </span>
                </div>
            </div>

            <x-button.a-primary x-bind:href="checkoutList.length ? '/konfirmasi?ids=' + checkoutList : ' '">
                Check out
            </x-button.a-primary>
        </div>
        <!-- totals - end -->
    </div>
</div>
