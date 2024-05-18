<?php

use App\Models\Kategori;
use App\Http\Controllers\ParseNumberInput;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Volt\Validate;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Tambah Kategori')] class extends Component {
    use WithFileUploads, ParseNumberInput, Toastable;

    public $gambar;
    public $nama = '';


    /**
     * Handle an incoming registration request.
     */
    public function add(): void
    {
        $this->validate([
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $path = $this->gambar->storePubliclyAs('gambar_kategori', Kategori::getNextSequenceValue(), 's3');

        Kategori::castAndCreate([
            'gambar' => 'https://palajawi.s3.ap-southeast-1.amazonaws.com/' . $path,
            'nama' => $this->nama,
        ]);

        $this->redirect(route('kategori.index', absolute: false), navigate: true);
        $this->success('Kategori berhasil ditambahkan');
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('kategori.index') }}">Kembali</x-button.a-secondary>
    <form wire:submit="add">
        <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
            <x-image-upload :data="$gambar" name='gambar'
                class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" required />
            <div class="grid flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
                <div class="sm:col-span-3">
                    <x-input-label for="nama" value="Nama Kategori" />
                    <x-text-input class="mt-1 block w-full" type="text" name="nama" wire:model='nama' required
                        autofocus />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Tambah</x-button.primary>
        </div>
    </form>
</div>
