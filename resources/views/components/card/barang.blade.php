@props(['id', 'cover', 'nama', 'namaKategori', 'harga', 'stok'])

<a href="{{ route('detail', $id) }}" wire:navigate
    class="overflow-hidden rounded-lg bg-white shadow-md shadow-[rgba(0,0,0,0.1)]">
    <img class="aspect-square w-full bg-gray-200 object-cover" src="{{ $cover }}" alt="{{ $nama }}">
    <div class="p-2">
        <p class="line-clamp-2 text-lg">{{ $nama }}</p>
        <p class="text-green-700">{{ $namaKategori }}</p>
        <p class="font-semibold">Rp. {{ number_format($harga, 0, ',', '.') }}</p>
        <p>Stok: {{ $stok }}</p>
    </div>
</a>
