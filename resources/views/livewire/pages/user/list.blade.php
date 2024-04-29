<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

new #[Layout('layouts.dashboard')] #[Title('Daftar Pengguna')] class extends Component {
    use WithPagination;

    public $id;

    public $columns = ['id', 'email', 'username', 'admin'];
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
        $data = User::orderBy('id');
        if ($this->query) {
            $data->whereFullText(['email', 'username'], $this->query);
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }

    public function view()
    {
        $this->redirect(route('user.show', $this->id), navigate: true);
    }
}; ?>

<div>
    <x-table route="user" :data="$list" :columns="array_slice($columns, 1)" :headers="['Email', 'Nama', 'Admin']" :actions="['view']">
        <x-compact-search-bar />
    </x-table>
</div>
