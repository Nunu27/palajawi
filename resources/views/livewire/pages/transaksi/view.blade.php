<?php

use App\Models\Transaksi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] #[Title('Detail Transaksi')] class extends Component {
    public $id;

    public function mount()
    {
        $this->id = Route::current()->parameter('id');
    }

    public function with()
    {
        return [
            'transaksi' => Transaksi::find($this->id),
        ];
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('transaksi.index') }}">Kembali</x-button.a-secondary>
    <div class="my-5 grid w-full flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
        <div class="col-span-3">
            <x-input-label for="id" value="ID" />
            <x-text-input class="mt-1 block w-full" type="text" name="id" :value='$transaksi->id' disabled autofocus />
        </div>
        <div>
            <x-input-label for="user" value="User" />
            <a href="{{ route('user.show', $transaksi->id_user) }}" wire:navigate>
                <x-text-input class="mt-1 block w-full cursor-pointer" type="text" name="user"
                    :value='$transaksi->user->username' />
            </a>
        </div>
        <div>
            <x-input-label for="metode_pembayaran" value="Metode Pembayaran" />
            <x-text-input class="mt-1 block w-full" type="text" name="metode_pembayaran"
                value="{{ $transaksi->metode_pembayaran }}" disabled autofocus />
        </div>
        <div>
            <x-input-label for="tanggal" value="Tanggal" />
            <x-text-input class="mt-1 block w-full" type="text" name="tanggal" :value="$transaksi->created_at" disabled
                {{-- <x-text-input class="mt-1 block w-full" type="text" name="tanggal" :value="'Rp. ' . number_format($transaksi->total_harga, 0, ',', '.')" disabled --}} autofocus />
        </div>
    </div>
</div>
