<x-dashboard-layout title='Daftar Transaksi'>
    <x-table :keys="['ID', 'Total', 'Metode Pembayaran', 'Status']">
        <x-compact-search-bar />
    </x-table>
    {{ $list->links() }}
</x-dashboard-layout>
