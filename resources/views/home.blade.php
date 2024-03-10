<x-app-layout>
    <x-slot name="title">Palajawi - Home</x-slot>

    <h1 class="my-5 text-2xl">Daftar kategori</h1>
    <div class="flex gap-5">
        <x-card.kategori :nama="__('Mentah')" />
        <x-card.kategori :nama="__('Cemilan')" />
        <x-card.kategori :nama="__('Minuman')" />
    </div>

    <h1 class="my-5 text-2xl">Barang populer</h1>
    <div class="flex gap-5">
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Jagung')" />
        <x-card.barang :nama="__('Ubi')" />
        <x-card.barang :nama="__('Ubi')" />
    </div>
    <h1 class="my-5 text-2xl">Barang terbaru</h1>
</x-app-layout>
