@props(['name', 'data' => null, 'alt', 'placeholder', 'required', 'disabled' => false])

<div {{ $attributes->merge(['class' => 'relative'])->class(['cursor-pointer' => !$disabled]) }}>
    <input type="file" wire:model="{{ $name }}" accept="image/*" @required($required ?? false)
        class="absolute h-full w-full opacity-0" @disabled($disabled)>
    <img src="{{ $data ? $data->temporaryUrl() : $placeholder ?? '/images/placeholder.jpg' }}"
        alt="{{ $alt ?? 'Gambar' }}" class="h-full w-full object-cover">
</div>
