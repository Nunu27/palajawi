<x-app-layout title="Beranda">
    {{-- TODO: Beranda UI --}}

    <h1 class="my-5 text-2xl">Daftar kategori</h1>
    <div class="flex gap-5">
    </div>

    <h1 class="my-5 text-2xl">Barang populer</h1>
    <div class="flex gap-5">
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
    </div>
    <h1 class="my-5 text-2xl">Barang terbaru</h1>
</x-app-layout>
