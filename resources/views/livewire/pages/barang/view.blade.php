<?php

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Controllers\ParseNumberInput;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Volt\Validate;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Detail Barang')] class extends Component {
    public $id;

    public function mount()
    {
        $this->id = Route::current()->parameter('id');
    }

    public function with()
    {
        return [
            'barang' => Barang::find($this->id),
        ];
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('barang.index') }}">Kembali</x-button.a-secondary>
    <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
        <x-image-upload name='cover' :placeholder="$barang->cover"
            class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" />
        <div class="grid w-full flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
            <div class="sm:col-span-3">
                <x-input-label for="nama" value="Nama Barang" />
                <x-text-input class="mt-1 block w-full" type="text" name="nama" :value='$barang->nama' disabled
                    autofocus />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="kategori" value="Kategori" />
                <x-text-input class="mt-1 block w-full" type="text" name="kategori" :value='$barang->kategori->nama' disabled />
                <x-input-error :messages="$errors->get('idKategori')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="harga" value="Harga" />
                <x-text-input class="mt-1 block w-full" type="text" name="harga" :value="'Rp. ' . number_format($barang->harga, 0, ',', '.')" disabled
                    autofocus />
                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="stok" value="Stok" />
                <x-text-input class="mt-1 block w-full" type="text" name="stok" :value="number_format($barang->stok, 0, ',', '.')" disabled
                    autofocus />
                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
            </div>
            <div class="sm:col-span-3">
                <x-input-label for="deskripsi" value="Deskripsi" />
                <x-text-area id="deskripsi" class="mt-1 block w-full" type="text" name="deskripsi" disabled
                    maxlength='4095' autofocus>{{ $barang->deskripsi }}</x-text-area>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-2">
        <x-button.danger>Hapus</x-button.danger>
        <x-button.a-primary href="{{ route('barang.edit', $id) }}">Edit</x-button.a-primary>
    </div>
</div>
