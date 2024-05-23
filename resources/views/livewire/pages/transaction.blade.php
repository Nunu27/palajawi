<?php

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\StatusTransaksi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.app')] #[Title('Detail Transaksi')] class extends Component {
    use Toastable;

    public $id;
    public $transaksi;

    public function mount()
    {
        $this->id = Route::current()->parameter('id');
        $this->transaksi = Transaksi::where('id', $this->id)
            ->with(['daftar_barang', 'daftar_barang.barang'])
            ->get()[0];
    }

    public function bayar()
    {
        $this->transaksi->castAndUpdate([
            'status' => StatusTransaksi::DONE,
        ]);
    }
}; ?>

<div>
    <div class="heading mb-4 text-2xl font-semibold">Detail Transaksi</div>

    <div class="container h-auto rounded-lg bg-white p-4 shadow-md">
        <div class="mb-4 text-xl font-semibold">ID: {{ $transaksi->id }}</div>
        <div class="container border-y py-4">
            <div class="font-medium">Daftar pesanan</div>
            @foreach ($transaksi->daftar_barang as $barang)
                <div class="flex">
                    <div class="flex-1 font-light">{{ $barang->barang->nama }}</div>
                    <div class="font-light">Rp. {{ number_format($barang->barang->harga, 0, ',', '.') }} x
                        {{ number_format($barang->jumlah, 0, ',', '.') }}</div>
                    <div class="w-1/6 text-right font-light">Rp.
                        {{ number_format($barang->barang->harga * $barang->jumlah, 0, ',', '.') }}</div>
                </div>
            @endforeach
        </div>
        <div class="flex pt-4">
            <div class="container w-4/6">
                <div class="text-xl font-semibold">Total Tagihan</div>
                <div>Metode Pembayaran</div>
                <div>Status</div>
            </div>
            <div class="container w-2/6 text-right">
                <div>Rp.
                    {{ number_format(
                        $transaksi->daftar_barang->reduce(function ($carry, $item) {
                            return $carry + $item->barang->harga * $item->jumlah;
                        }),
                        0,
                        ',',
                        '.',
                    ) }}
                </div>
                <div>{{ $transaksi->metode_pembayaran }}</div>
                <div>{{ $transaksi->status }}</div>
            </div>
        </div>
        @if ($transaksi->status == StatusTransaksi::WAITING)
            <button wire:click='bayar' wire:loading.attr="disabled"
                class="mt-8 w-full rounded-lg border bg-green-400 py-2">Bayar</button>
        @endif
    </div>
</div>
