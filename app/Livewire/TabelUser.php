<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TabelUser extends Component
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
        $route = 'user';
        $headers = ['ID', 'Email', 'Nama', 'Admin'];
        $columns = ['id', 'email', 'username', 'admin'];
        $actions = ['view'];
        $data = User::orderBy('id');
        if ($this->query)
            $data->whereFullText(['nama', 'deskripsi'], $this->query);
        $list = $data->paginate($this->perPage, $columns);

        return view('livewire.table', compact('route', 'headers', 'columns', 'actions', 'list'));
    }
}
