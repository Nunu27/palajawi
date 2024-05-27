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

new #[Layout('layouts.dashboard')] #[Title('Tambah Barang')] class extends Component {
    use WithFileUploads, ParseNumberInput, Toastable;

    public $cover;
    public $nama = '';
    public $idKategori;
    public $harga = '';
    public $stok = '';
    public $deskripsi = '';

    public function with()
    {
        return [
            'kategoriList' => Kategori::all(),
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function add(): void
    {
        $this->validate([
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $path = $this->cover->storePubliclyAs('cover_barang', Barang::getNextSequenceValue(), 's3');

        Barang::castAndCreate([
            'cover' => 'https://palajawi.s3.ap-southeast-1.amazonaws.com/' . $path,
            'nama' => $this->nama,
            'id_kategori' => $this->idKategori,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->parseNumberInput($this->harga),
            'stok' => $this->parseNumberInput($this->stok),
        ]);

        $this->redirect(route('barang.index', absolute: false), navigate: true);
        $this->success('Barang berhasil ditambahkan');
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('barang.index') }}">Kembali</x-button.a-secondary>
    <form wire:submit="add">
        <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
            <x-image-upload :data="$cover" name='cover'
                class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" required />
            <div class="grid flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
                <div class="sm:col-span-3">
                    <x-input-label for="nama" value="Nama Barang" />
                    <x-text-input class="mt-1 block w-full" type="text" name="nama" wire:model='nama' required
                        autofocus />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="kategori" value="Kategori" />
                    <select wire:model='idKategori' name="kategori" id="kategori"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idKategori')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="harga" value="Harga" />
                    <x-text-input class="mt-1 block w-full" type="text" name="harga" wire:model='harga' required
                        autofocus oninput="formatInputNumber(event, {prefix: 'Rp. '})" />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="stok" value="Stok" />
                    <x-text-input class="mt-1 block w-full" type="text" name="stok" wire:model='stok' required
                        autofocus oninput="formatInputNumber(event)" />
                    <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                </div>
                <div class="sm:col-span-3">
                    <x-input-label for="deskripsi" value="Deskripsi" />
                    <x-text-area id="deskripsi" class="mt-1 block w-full" type="text" name="deskripsi"
                        wire:model='deskripsi' required autofocus />
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Tambah</x-button.primary>
        </div>
    </form>
</div>
