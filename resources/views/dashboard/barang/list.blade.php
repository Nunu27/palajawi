<x-dashboard-layout title='Daftar Barang'>

    <x-table route="{{ $route }}" :data="$list" :columns="$columns" :headers="$headers" :actions="$actions">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('barang.create') }}">Tambah</x-button.a-primary>
    </x-table>
</x-dashboard-layout>
