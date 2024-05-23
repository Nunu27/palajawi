@props(['id', 'gambar', 'nama'])

<a href="{{ route('filter') . '?kategori=' . $id }}"
    class="group relative mb-2 block h-60 overflow-hidden rounded-lg bg-lime-100 lg:mb-3">
    <img src="{{ $gambar }}" loading="lazy" alt="Photo by Rachit Tank"
        class="object-center transition duration-200 group-hover:scale-110" />
    <span
        class="absolute bottom-0 left-0 right-0 rounded-br-lg px-3 py-1.5 text-center font-sans text-xl font-normal tracking-wider text-black">
        {{ $nama }}
    </span>
</a>
