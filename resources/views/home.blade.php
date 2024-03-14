<x-app-layout title="Beranda">
    <h1 class="my-5 text-2xl">Daftar kategori</h1>
    <div class="flex gap-5">
        <x-card.kategori nama="Mentah" />
        <x-card.kategori nama="Cemilan" />
        <x-card.kategori nama="Minuman" />
    </div>

    <h1 class="my-5 text-2xl">Barang populer</h1>
    <div class="flex gap-5">
        <x-card.barang nama="Ubi" />
        <x-card.barang nama="Jagung" />
        <x-card.barang nama="Ubi" />
        <x-card.barang nama="Ubi" />
    </div>
    <h1 class="my-5 text-2xl">Barang terbaru</h1>
</x-app-layout>
