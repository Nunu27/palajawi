<?php

use App\Models\Transaksi;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] #[Title('Histori Transaksi')] class extends Component {
    use WithPagination;

    public $id;

    public $columns = ['id', 'total_harga', 'status', 'updated_at'];
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
        $data = Transaksi::orderBy('updated_at', 'DESC')->where('id_user', request()->user()->id);
        if ($this->query) {
            $data = $data->where('id', 'ILIKE', '%' . trim($this->query) . '%');
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }

    public function view()
    {
        $this->redirect(route('user.transaction.show', $this->id), navigate: true);
    }
}; ?>

<div>
    <div class="mx-auto mb-6 max-w-7xl space-x-6 px-6 font-bold lg:px-8">
        <x-nav-link.app route="profile">Data akun</x-nav-link.app>
        <x-nav-link.app route="user.transactions">Histori Transaksi</x-nav-link.app>
    </div>
    <x-table route='user.transaction' :data="$list" :columns="['id', ['total_harga', 'number', 'Rp. '], 'status', 'updated_at']" :headers="['ID', 'Total Harga', 'Status', 'Tanggal']" :actions="['view']">
        <x-compact-search-bar />
    </x-table>
</div>
