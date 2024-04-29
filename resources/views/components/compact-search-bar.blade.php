<form wire:submit="refresh" class="flex items-center rounded-md">
    <input type="search" name="query" id="query" class="h-full rounded-l-md border py-1 pl-2 pr-0 text-sm"
        wire:model='query'>
    <x-button.primary class="flex h-full w-10 justify-center rounded-l-none px-2 py-1">
        <x-gmdi-search class="h-6" />
    </x-button.primary>
</form>
