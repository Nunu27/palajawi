<x-dashboard-layout title='Edit Barang'>
    {{-- TODO: Detail barang dashboard (copas dari tambah) --}}

    <x-button.a-secondary href="{{ route('barang.show', $barang->id) }}">Kembali</x-button.a-secondary>
</x-dashboard-layout>
