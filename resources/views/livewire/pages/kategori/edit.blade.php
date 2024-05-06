<?php

use App\Models\Kategori;
use App\Http\Controllers\ParseNumberInput;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Volt\Validate;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Edit Kategori')] class extends Component {
    use WithFileUploads, ParseNumberInput, Toastable;

    public $id;
    public $gambar;
    public $oldGambar = '';
    public $nama = '';

    public function mount(): void
    {
        $this->id = Route::current()->parameter('id');
        $kategori = Kategori::find($this->id);

        $this->oldGambar = $kategori->gambar;
        $this->nama = $kategori->nama;
        $this->idKategori = $kategori->id_kategori;
    }

    /**
     * Handle an incoming registration request.
     */
    public function edit(): void
    {
        $this->validate([
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($this->gambar) {
            $this->gambar->storePubliclyAs('gambar_kategori', $this->id, 's3');
        }

        Kategori::find($this->id)->castAndUpdate([
            'nama' => $this->nama,
        ]);

        $this->redirectRoute('kategori.show', ['id' => $this->id]);
        $this->success('Kategori berhasil diubah');
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('kategori.show', $id) }}">Kembali</x-button.a-secondary>
    <form wire:submit="edit">
        <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
            <x-image-upload :data="$gambar" name='gambar' :placeholder="$oldGambar"
                class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" />
            <div class="grid w-full flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
                <div class="sm:col-span-3">
                    <x-input-label for="nama" value="Nama Kategori" />
                    <x-text-input class="mt-1 block w-full" type="text" name="nama" wire:model='nama' required
                        autofocus />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Simpan</x-button.primary>
        </div>
    </form>
</div>
