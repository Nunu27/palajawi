<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class TabelTransaksi extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $query = '';

    public function refresh()
    {
        $this->resetPage();
    }

    public function render()
    {
        $route = 'barang';
        $headers = ['ID', 'Cover', 'Nama', 'Harga', 'Stok'];
        $columns = ['id', ['cover', 'image'], 'nama', ['harga', 'number', 'Rp. '], ['stok', 'number']];
        $actions = ['view', 'edit', 'delete'];
        $data = Barang::orderBy('id');
        if ($this->query)
            $data->whereFullText(['nama', 'deskripsi'], $this->query);
        $list = $data->paginate($this->perPage, $columns);

        return view('livewire.table', compact('route', 'headers', 'columns', 'actions', 'list'));
    }
}
