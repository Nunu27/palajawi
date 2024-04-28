<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] #[Title('Tambah Barang')] class extends Component {
    use WithFileUploads, ParseNumberInput;

    #[Validate('required|image|mimes:jpeg,png,jpg|max:2048')]
    public $cover;
    public $nama = '';
    public $idKategori = '';
    public $harga = '';
    public $stok = '';
    public $deskripsi = '';

    /**
     * Handle an incoming registration request.
     */
    public function add(): void
    {
        $path = Storage::disk('s3')->put('images', $request->cover, Barang::getNextSequenceValue());
        if (!$path) {
            return [
                'success' => false,
                'message' => 'Gagal mengunggah gambar',
            ];
        }

        $barang = $this->all();
        $barang['harga'] = $this->parseNumberInput($barang['harga']);
        $barang['stok'] = $this->parseNumberInput($barang['stok']);
        $barang['cover'] = $path;
        $barang['id_kategori'] = 1;

        Barang::castAndCreate($barang);

        $this->redirect(route('barang.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-button.a-secondary href="{{ route('barang.index') }}">Kembali</x-button.a-secondary>

    <form wire:submit="add">
        <div class="flex flex-col gap-4 lg:flex-row">
            <div class="flex justify-center">
                <x-image-upload name='cover' class="max-w-72 aspect-square w-full rounded-md border border-gray-300"
                    required />
            </div>
            <div class="grid flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="nama" value="Nama Barang" />
                    <x-text-input class="mt-1 block w-full" type="text" name="nama" required autofocus />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="harga" value="Harga" />
                    <x-text-input class="mt-1 block w-full" type="text" name="harga" required autofocus
                        oninput="formatInputNumber(event, {prefix: 'Rp. '})" />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="stok" value="Stok" />
                    <x-text-input class="mt-1 block w-full" type="text" name="stok" required autofocus
                        oninput="formatInputNumber(event)" />
                    <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="deskripsi" value="Deskripsi" />
                    <x-text-area id="deskripsi" class="mt-1 block w-full" type="text" name="deskripsi"
                        maxlength='4095' required autofocus />
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Tambah</x-button.primary>
        </div>
    </form>
</div>
