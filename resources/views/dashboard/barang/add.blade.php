<x-dashboard-layout title='Tambah Barang'>
    {{-- TODO: pilih kategori --}}

    <x-button.a-secondary href="{{ route('barang.index') }}">Kembali</x-button.a-secondary>
    <x-form action="{{ route('barang.store') }}" method="POST" class="my-5 space-y-5">
        <div class="flex flex-col gap-4 lg:flex-row">
            <div class="flex justify-center">
                <x-image-upload name='cover' class="max-w-72 aspect-square w-full rounded-md border border-gray-300"
                    required />
            </div>
            <div class="grid flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="nama" value="Nama Barang" />
                    <x-text-input class="mt-1 block w-full" type="text" name="nama" required autofocus />
                    <x-input-error name='nama' class="mt-2" />
                </div>
                <div>
                    <x-input-label for="harga" value="Harga" />
                    <x-text-input class="mt-1 block w-full" type="text" name="harga" required autofocus
                        oninput="formatInputNumber(event, {prefix: 'Rp. '})" />
                    <x-input-error name='harga' class="mt-2" />
                </div>
                <div>
                    <x-input-label for="stok" value="Stok" />
                    <x-text-input class="mt-1 block w-full" type="text" name="stok" required autofocus
                        oninput="formatInputNumber(event)" />
                    <x-input-error name='stok' class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="deskripsi" value="Deskripsi" />
                    <x-text-area id="deskripsi" class="mt-1 block w-full" type="text" name="deskripsi"
                        maxlength='4095' required autofocus />
                    <x-input-error name='deskripsi' class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Tambah</x-button.primary>
        </div>
    </x-form>
</x-dashboard-layout>
