<?php

use App\Models\Barang;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.dashboard')] #[Title('Daftar Barang')] class extends Component {
    use WithPagination, Toastable;

    public $id;

    #[Url(as: 'per_page')]
    public int $perPage = 10;
    #[Url(except: '')]
    public string $query = '';
    #[Url]
    public $kategori;

    public function refresh(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $data = Barang::orderBy('id');
        if ($this->kategori) {
            $data->where('id_kategori', $this->kategori);
        }
        if ($this->query) {
            $data->where('nama', 'ILIKE', '%' . trim($this->query) . '%');
        }
        $list = $data->with('kategori')->paginate($this->perPage, ['id', 'cover', 'nama', 'id_kategori', 'harga', 'stok']);

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

    public function delete()
    {
        Barang::find($this->id)->delete();
        Storage::disk('s3')->delete('cover_barang/' . $this->id);
        $this->success('Barang berhasil dihapus');
    }
}; ?>

<div>
    <x-table route="barang" :data="$list" :columns="[
        ['cover', 'image'],
        'nama',
        ['kategori', 'relation', 'nama'],
        ['harga', 'number', 'Rp. '],
        ['stok', 'number'],
    ]" :headers="['Cover', 'Nama', 'Kategori', 'Harga', 'Stok']" :actions="['view', 'edit', 'delete']">
        <x-compact-search-bar />
        <x-button.a-primary href="{{ route('barang.create') }}">Tambah</x-button.a-primary>
    </x-table>

    <x-confirmation-modal name='delete' title="Hapus barang" message='Apakah anda yakin untuk menghapus barang ini?'
        click='delete' />
</div>
