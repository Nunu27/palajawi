<x-dashboard-layout title='Daftar Barang'>
    <x-table :headers="['ID', 'Cover', 'Nama', 'Harga']" :actions="['view', 'edit', 'delete']">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('barang.create') }}">Tambah</x-button.a-primary>
    </x-table>
</x-dashboard-layout>
