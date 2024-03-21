<x-dashboard-layout title='Daftar Pengguna'>
    <x-table route="user" :data="$list" :columns="$columns" :headers="['ID', 'Email', 'Nama', 'Admin']" :actions="['view']">
        <x-compact-search-bar />
    </x-table>
</x-dashboard-layout>
