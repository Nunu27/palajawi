@props(['name', 'show' => false, 'title', 'message', 'click'])

<x-modal :name="$name" :show="$show" focusable>
    <div class="p-6">
        <h2 class="text-lg font-bold text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ $message }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-button.secondary @click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-button.secondary>

            <x-button.danger class="ms-3" @click="$dispatch('close')" wire:click='{{ $click }}'>
                {{ __('Yes') }}
            </x-button.danger>
        </div>
    </div>
</x-modal>
