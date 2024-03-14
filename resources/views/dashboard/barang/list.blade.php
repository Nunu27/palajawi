<x-dashboard-layout title='Daftar Barang'>
    <x-table :keys="['ID', 'Cover', 'Nama', 'Harga']" :actions="['view', 'edit', 'delete']">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('barang.create') }}">Tambah</x-button.a-primary>
    </x-table>
    {{ $list->links() }}
</x-dashboard-layout>
