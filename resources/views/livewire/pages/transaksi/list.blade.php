<?php

use App\Models\Transaksi;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

new #[Layout('layouts.dashboard')] #[Title('Daftar Transaksi')] class extends Component {
    use WithPagination;

    public $id;

    public $columns = ['id', 'id_user', 'total_harga', 'status', 'updated_at'];
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
        $data = Transaksi::orderBy('updated_at');
        if ($this->query) {
            $data->where('id', 'ILIKE', '%' . trim($this->query) . '%');
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }

    public function view()
    {
        $this->redirect(route('transaksi.show', $this->id), navigate: true);
    }
}; ?>

<div>
    <x-table :data="$list" :columns="['id', 'id_user', ['total_harga', 'number', 'Rp. '], 'status', 'updated_at']" :headers="['ID', 'ID User', 'Total Harga', 'Status', 'Tanggal']" :actions="['view']">
        <x-compact-search-bar />
    </x-table>
</div>
