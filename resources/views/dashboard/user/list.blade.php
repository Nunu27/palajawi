<x-dashboard-layout title='Daftar Pengguna'>
    <x-table route="{{ $route }}" :data="$list" :columns="$columns" :headers="$headers" :actions="$actions">
        <x-compact-search-bar />
    </x-table>
</x-dashboard-layout>
