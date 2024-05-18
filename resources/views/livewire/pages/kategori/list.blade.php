<?php

use App\Models\Kategori;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Daftar Kategori')] class extends Component {
    use WithPagination, Toastable;

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
            $data->where('nama', 'ILIKE', '%' . trim($this->query) . '%');
        }
        $list = $data->paginate($this->perPage, $this->columns);

        return ['list' => $list];
    }

    public function view()
    {
        $this->redirect(route('kategori.show', $this->id), navigate: true);
    }

    public function edit()
    {
        $this->redirect(route('kategori.edit', $this->id), navigate: true);
    }

    public function delete()
    {
        Kategori::find($this->id)->delete();
        $this->success('Kategori berhasil dihapus');
    }
}; ?>

<div>
    <x-table route='kategori' :data="$list" :columns="[['gambar', 'image'], 'nama']" :headers="['Gambar', 'Nama']" :actions="['view', 'edit', 'delete']">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('kategori.create') }}">Tambah</x-button.a-primary>
    </x-table>

    <x-confirmation-modal name='delete' title="Hapus kategori" message='Apakah anda yakin untuk menghapus kategori ini?'
        click='delete' />
</div>
