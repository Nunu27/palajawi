<x-dashboard-layout title='Daftar Pengguna'>
    <x-table :keys="['ID', 'Email', 'Nama', 'Admin']" :actions="['view']">
        <x-compact-search-bar />
    </x-table>
    {{ $list->links() }}
</x-dashboard-layout>
