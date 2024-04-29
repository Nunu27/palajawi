@props(['name', 'data' => null, 'alt', 'placeholder', 'required'])

<div {{ $attributes->merge(['class' => 'relative']) }}>
    <input type="file" wire:model="{{ $name }}" accept="image/*" @required($required ?? false)
        class="absolute h-full w-full cursor-pointer opacity-0">
    <img src="{{ $data ? $data->temporaryUrl() : $placeholder ?? '/images/placeholder.jpg' }}"
        alt="{{ $alt ?? 'Gambar' }}" class="h-full w-full object-cover">
</div>
