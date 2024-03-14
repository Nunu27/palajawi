<x-dashboard-layout title='Tambah Barang'>
    <x-button.secondary onclick="history.back()">Kembali</x-button.secondary>
    <form action="" class="space-y-5">
        <div class="flex flex-col">
            <x-text-input></x-text-input>
            <x-text-input></x-text-input>
            <x-text-input></x-text-input>
        </div>
        <div class="flex justify-end">
            <x-button.primary>Tambah</x-button.primary>
        </div>
    </form>
</x-dashboard-layout>
