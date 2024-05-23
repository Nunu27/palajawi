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

new #[Layout('layouts.dashboard')] #[Title('Edit Barang')] class extends Component {
    use WithFileUploads, ParseNumberInput, Toastable;

    public $id;
    public $cover;
    public $oldCover = '';
    public $nama = '';
    public $idKategori;
    public $harga = '';
    public $stok = '';
    public $deskripsi = '';

    public function mount(): void
    {
        $this->id = Route::current()->parameter('id');
        $barang = Barang::find($this->id);

        $this->oldCover = $barang->cover;
        $this->nama = $barang->nama;
        $this->idKategori = $barang->id_kategori;
        $this->harga = 'Rp. ' . number_format($barang->harga, 0, ',', '.');
        $this->stok = number_format($barang->stok, 0, ',', '.');
        $this->deskripsi = $barang->deskripsi;
    }

    public function with()
    {
        return [
            'kategoriList' => Kategori::all(),
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function edit(): void
    {
        $this->validate([
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($this->cover) {
            $this->cover->storePubliclyAs('cover_barang', $this->id, 's3');
        }

        if ($this->cover) {
            $path = 'https://palajawi.s3.ap-southeast-1.amazonaws.com/' . $this->cover->storePubliclyAs('cover_barang', $this->id, 's3');
        }

        Barang::find($this->id)->castAndUpdate([
            'cover' => $this->cover == null || $this->oldCover == $path ? $this->oldCover : $path,
            'nama' => $this->nama,
            'id_kategori' => $this->idKategori,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->parseNumberInput($this->harga),
            'stok' => $this->parseNumberInput($this->stok),
        ]);

        $this->redirectRoute('barang.show', ['id' => $this->id]);
        $this->success('Barang berhasil diubah');
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('barang.show', $id) }}">Kembali</x-button.a-secondary>
    <form wire:submit="edit">
        <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
            <x-image-upload :data="$cover" name='cover' :placeholder="$oldCover"
                class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" />
            <div class="grid w-full flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
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
                        wire:model='deskripsi' maxlength='4095' required autofocus />
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Simpan</x-button.primary>
        </div>
    </form>
</div>
