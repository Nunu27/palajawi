<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component {
    #[Url(except: '')]
    public $query = '';
    public $inFilter;

    public function mount()
    {
        $this->inFilter = str_starts_with($_SERVER['REQUEST_URI'], '/filter');
    }

    public function refresh()
    {
        if ($this->inFilter) {
            $this->dispatch('filter', $this->query);
        } else {
            $this->redirect('/filter?query=' . $this->query, navigate: true);
        }
    }
}; ?>

<div class="flex items-center">
    <input wire:model='query' wire:change='refresh' type="search" class="h-9 rounded-l-full border border-gray-200 text-sm"
        placeholder="Cari">
    <x-gmdi-search class="h-9 w-9 rounded-r-full border border-l-0 py-2 text-gray-500" />
</div>
