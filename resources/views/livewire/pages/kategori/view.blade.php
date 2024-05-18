<?php

use App\Models\Kategori;
use App\Http\Controllers\ParseNumberInput;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Volt\Validate;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Detail Kategori')] class extends Component {
    use Toastable;
    public $id;

    public function mount()
    {
        $this->id = Route::current()->parameter('id');
    }

    public function with()
    {
        return [
            'kategori' => Kategori::find($this->id),
        ];
    }

    public function delete()
    {
        Kategori::find($this->id)->delete();
        $this->redirect(route('kategori.index'), navigate: true);
        $this->success('Berhasil menghapus kategori');
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('kategori.index') }}">Kembali</x-button.a-secondary>
    <div class="my-5 flex flex-col items-center gap-6 lg:flex-row lg:items-start">
        <x-image-upload name='gambar' :placeholder="$kategori->gambar"
            class="max-w-72 aspect-square w-full overflow-hidden rounded-md border border-gray-300" disabled />
        <div class="grid w-full flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-3">
            <div class="sm:col-span-3">
                <x-input-label for="nama" value="Nama Kategori" />
                <x-text-input class="mt-1 block w-full" type="text" name="nama" :value='$kategori->nama' disabled
                    autofocus />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-2">
        <x-button.danger wire:click='delete'>Hapus</x-button.danger>
        <x-button.a-primary href="{{ route('kategori.edit', $id) }}">Edit</x-button.a-primary>
    </div>
</div>
