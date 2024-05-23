<?php

use App\Models\Barang;
use App\Models\Kategori;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Http\Controllers\ParseNumberInput;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new #[Layout('layouts.app')] #[Title('Filter')] class extends Component {
    use WithPagination, ParseNumberInput;

    #[Url(except: '')]
    public $query = '';
    #[Url(as: 'kategori')]
    public $kategoriId;
    #[Url]
    public ?string $min;
    #[Url]
    public ?string $max;
    #[Url(as: 'tersedia')]
    public $available;
    #[Url]
    public $order;

    public function boot()
    {
        $this->resetValidation();
        if (isset($this->min) && isset($this->max)) {
            Validator::make(['min' => $this->parseNumberInput($this->min), 'max' => $this->parseNumberInput($this->max)], ['max' => 'gte:min'])->validate();
        }
    }

    public function refresh(): void
    {
        $this->resetValidation();
        if (isset($this->min) && isset($this->max)) {
            Validator::make(['min' => $this->parseNumberInput($this->min), 'max' => $this->parseNumberInput($this->max)], ['max' => 'gte:min'])->validate();
        }
        $this->resetPage();
    }

    #[On('filter')]
    public function filter($query)
    {
        $this->query = $query;
        $this->refresh();
    }

    public function with()
    {
        $data = Barang::orderBy('harga', $this->order == 'max' ? 'DESC' : 'ASC');
        if ($this->kategoriId) {
            $data->where('id_kategori', $this->kategoriId);
        }
        if ($this->query) {
            $data->where('nama', 'ILIKE', '%' . trim($this->query) . '%');
        }
        if (isset($this->min)) {
            $data->where('harga', '>=', $this->parseNumberInput($this->min));
        }
        if (isset($this->max)) {
            $data->where('harga', '<=', $this->parseNumberInput($this->max));
        }
        if ($this->available) {
            $data->where('stok', '>', 0);
        }

        if (isset($minPrice) && isset($maxPrice)) {
            if ($minPrice > $maxPrice) {
                $this->addError(['max'], ['Harga maksimum harus lebih besar dari harga minimum.']);
            }
        }

        return [
            'kategori' => Kategori::all(),
            'data' => $data->with('kategori')->paginate(2, ['id', 'cover', 'nama', 'id_kategori', 'harga', 'stok']),
        ];
    }
}; ?>

<div>
    <div class="flex gap-4">
        <div x-data="{
            activeAccordion: [],
            toggleAccordion(id) {
                if (this.activeAccordion.includes(id)) {
                    this.activeAccordion = this.activeAccordion.filter((item) => item != id);
                } else {
                    this.activeAccordion.push(id);
                }
            }
        }"
            class="max-w-56 relative mx-auto h-min w-full divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-200 bg-white text-sm font-normal">
            <div x-data="{ id: $id('accordion') }" class="group cursor-pointer">
                <button @click="toggleAccordion(id)"
                    class="flex w-full select-none items-center justify-between p-4 text-left group-hover:underline">
                    <span class="font-bold">Kategori</span>
                    <svg class="h-4 w-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion.includes(id) }"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div x-show="activeAccordion.includes(id)" x-collapse x-cloak>
                    <div class="p-4 pt-0 opacity-70">
                        @foreach ($kategori as $item)
                            <div class="flex items-center">
                                <input wire:model='kategoriId' wire:change='refresh' type="radio" name="kategori"
                                    id="{{ $item->id }}" value="{{ $item->id }}">
                                <label for="{{ $item->id }}" class="p-2">{{ $item->nama }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div x-data="{ id: $id('accordion') }" class="group cursor-pointer">
                <button @click="toggleAccordion(id)"
                    class="flex w-full select-none items-center justify-between p-4 text-left group-hover:underline">
                    <span class="font-bold">Harga</span>
                    <svg class="h-4 w-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion.includes(id) }"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div x-show="activeAccordion.includes(id)" x-collapse x-cloak>
                    <div class="space-y-2 p-4 pt-0 opacity-70">
                        <x-text-input wire:model='min' wire:change='refresh' id="min" class="mt-1 block w-full"
                            type="text" name="min" oninput="formatInputNumber(event, {prefix: 'Rp. '})"
                            placeholder="Harga minimum" />
                        <x-input-error :messages="$errors->get('min')" class="mt-2" />
                        <x-text-input wire:model='max' wire:change='refresh' id="max" class="mt-1 block w-full"
                            type="text" name="max" oninput="formatInputNumber(event, {prefix: 'Rp. '})"
                            placeholder="Harga maksimum" />
                        <x-input-error :messages="$errors->get('max')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="group">
                <div class="p-4 opacity-70">
                    <input wire:model='available' type="checkbox" name="available" id="available">
                    <label for="available" class="p-2">Stok tersedia</label>
                </div>
            </div>
        </div>
        <div class="flex-1 space-y-4">
            <div class="flex items-center justify-between">
                <p class="text-sm leading-5 text-gray-700">
                    <span>{!! __('Showing') !!}</span>
                    <span class="font-medium">{{ $data->firstItem() ?? 0 }}</span>
                    <span>{!! __('to') !!}</span>
                    <span class="font-medium">{{ $data->lastItem() ?? 0 }}</span>
                    <span>{!! __('of') !!}</span>
                    <span class="font-medium">{{ $data->total() }}</span>
                    <span>{!! __('results') !!}</span>
                    @if ($query)
                        <span>Untuk</span>
                        <span class="font-medium">"{{ $query }}"</span>
                    @endif
                </p>
                <div>
                    <select wire:model='order' wire:change='refresh' name="order" id="order"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="min">Harga terendah</option>
                        <option value="max">Harga tertinggi</option>
                    </select>
                </div>
            </div>
            <span wire:loading>Memuat...</span>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5" wire:loading.remove>
                @foreach ($data as $barang)
                    <x-card.barang :id="$barang->id" :cover="$barang->cover" :nama="$barang->nama" :namaKategori="$barang->kategori->nama"
                        :harga="$barang->harga" :stok="$barang->stok" />
                @endforeach
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>
