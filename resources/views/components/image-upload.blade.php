@props(['name', 'alt', 'placeholder', 'required'])

@php
    if (!isset($placeholder)) {
        $placeholder = '/images/placeholder.jpg';
    }
@endphp

<div x-data="{
    image: null,
    changeImage(e) {
        if (this.image) URL.revokeObjectURL(this.image);

        const file = e.target.files[0];
        if (file) this.image = URL.createObjectURL(file);
        else this.image = null;
    }
}" {{ $attributes->merge(['class' => 'relative']) }}>
    <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/*" @change="changeImage($event)"
        @required($required ?? false) class="absolute h-full w-full cursor-pointer opacity-0">
    <img :src="image ?? '{{ $placeholder }}'" alt="{{ $alt ?? 'Gambar' }}" class="h-full w-full object-cover">
</div>
