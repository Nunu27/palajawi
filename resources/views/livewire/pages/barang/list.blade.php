<?php

use App\Models\Barang;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

new #[Layout('layouts.dashboard')] #[Title('Daftar Barang')] class extends Component {
    use WithPagination;

    public $columns = ['id', ['cover', 'image'], 'nama', ['harga', 'number', 'Rp. '], ['stok', 'number']];
    #[Url(as: 'per_page')]
    public int $perPage = 10;
    #[Url(except: '')]
    public string $query = '';

    public function refresh(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $data = Barang::orderBy('id');
        if ($this->query) {
            $data->whereFullText(['nama', 'deskripsi'], $this->query);
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }
}; ?>

<div>
    <x-table route="user" :data="$list" :columns="$columns" :headers="['ID', 'Email', 'Nama', 'Admin']" :actions="['view']">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('barang.create') }}">Tambah</x-button.a-primary>
    </x-table>
</div>
