<?php

use App\Models\Kategori;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

new #[Layout('layouts.dashboard')] #[Title('Daftar Kategori')] class extends Component {
    use WithPagination;

    public $id;

    public $columns = ['id', 'gambar', 'nama'];
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
        $data = Kategori::orderBy('id');
        if ($this->query) {
            $data->whereFullText(['nama'], $this->query);
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }

    public function view()
    {
        $this->redirect(route('barang.show', $this->id), navigate: true);
    }

    public function edit()
    {
        $this->redirect(route('barang.edit', $this->id), navigate: true);
    }
}; ?>

<div>
    <x-table :data="$list" :columns="[['gambar', 'image'], 'nama']" :headers="['Gambar', 'Nama']" :actions="['view', 'edit', 'delete']">
        <x-compact-search-bar />
    </x-table>
</div>
