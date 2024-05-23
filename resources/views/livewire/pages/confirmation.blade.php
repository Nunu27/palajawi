<?php

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\BarangTransaksi;
use App\Models\MetodePembayaran;
use App\Models\StatusTransaksi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toastable;

new #[Layout('layouts.app')] #[Title('Konfirmasi Pesanan')] class extends Component {
    use Toastable;

    public $user;
    public $ids;
    public $alamat;
    public $metode = 'COD';
    public $keranjang;

    public function mount()
    {
        $raw = request()->query('ids');
        $this->ids = $raw ? explode(',', $raw) : [];
        $this->user = request()->user();
        $this->alamat = $this->user->alamat;
        $this->keranjang =
            count($this->ids) > 0
                ? Keranjang::where('id_user', $this->user->id)
                    ->whereIn('id', $this->ids)
                    ->with(['barang', 'barang.kategori'])
                    ->get()
                : null;
    }

    public function confirm()
    {
        $id = uuid_create();
        Transaksi::castAndCreate([
            'id' => $id,
            'id_user' => $this->user->id,
            'metode_pembayaran' => MetodePembayaran::from($this->metode),
            'status' => $this->metode == 'COD' ? StatusTransaksi::PROCESSING : StatusTransaksi::WAITING,
        ]);

        foreach ($this->keranjang as $index => $item) {
            BarangTransaksi::castAndCreate([
                'id_transaksi' => $id,
                'id_barang' => $item->id_barang,
                'jumlah' => $item->jumlah,
            ]);
            $item->delete();
        }

        $this->redirect(route('user.transaction.show', $id, absolute: false), navigate: true);
        $this->success('Transaksi berhasil dibuat');
    }
}; ?>


<div>
    @if (isset($keranjang))
        <form wire:submit="confirm">
            <div class="min-w-5-5 mx-5s">
                <div class="mb-2 flex items-center justify-between">
                    <h1 class="text-3xl font-bold">Pesanan anda</h1>
                    <div class="justify-between"></div>
                </div>
                <div class="flex justify-between">
                    <p class="mb-4 text-sm text-gray-700">Periksa status pesanan terbaru anda dengan cermat</p>
                    <div class="text-sm font-semibold text-gray-700">Total Amount Rp.
                        {{ number_format(
                            $keranjang->reduce(function ($carry, $item) {
                                return $carry + $item->barang->harga * $item->jumlah;
                            }),
                            0,
                            ',',
                            '.',
                        ) }}
                    </div>
                </div>
                <div class="space-y-4">
                    @foreach ($keranjang as $barang)
                        <div class="flex items-center rounded-lg bg-white">
                            <img class="float-left h-32 w-32 rounded border object-cover"
                                src="{{ $barang->barang->cover }}" alt="{{ $barang->barang->nama }}"
                                style="width: 128px; height: 128px;" />
                            <div class="flex-1 p-4">
                                <h2 class="text-lg font-bold">{{ $barang->barang->nama }}</h2>
                                <p class="my-1 text-sm font-thin">Harga: Rp.
                                    {{ number_format($barang->barang->harga, 0, ',', '.') }}</p>
                                <div class="flex justify-between">
                                    <p class="my-1 text-sm font-thin">Jumlah:
                                        {{ number_format($barang->jumlah, 0, ',', '.') }}</p>
                                    <p class="my-1 text-sm font-thin">Rp.
                                        {{ number_format($barang->barang->harga * $barang->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="min-w-5-5 mx-5s py-4">
                <div class="mb-2 flex items-center justify-between">
                    <h1 class="text-xl font-bold">Silakan isi data pribadi Anda di bawah ini!</h1>
                    <div class="justify-between"></div>
                </div>
                <p class="mb-4 text-sm text-gray-700">Silakan isi data pribadi Anda di bawah ini dengan cermat!</p>
            </div>
            <div
                class="mx-auto max-w-full space-y-2 rounded-md bg-white px-8 py-8 shadow-lg sm:flex sm:space-x-6 sm:space-y-0 sm:py-4">
                <div class="w-full text-left sm:text-left">
                    <x-input-label for="alamat" value="Alamat" />
                    <x-text-area id="alamat" class="mt-1 block w-full" type="text" name="alamat"
                        wire:model='alamat' maxlength='4095' required autofocus disabled />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>
                <div class="w-full text-left sm:text-left">
                    <x-input-label for="metode" value="Metode Pembayaran" />
                    <select wire:model='metode' name="metode" id="metode"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="COD">COD</option>
                        <option value="PRIS">PRIS</option>
                    </select>
                    <x-input-error :messages="$errors->get('metode')" class="mt-2" />
                </div>

            </div>


            <div class="py-5">

                <div class="mb-4 flex rounded-lg bg-red-50 p-4 text-sm text-red-800" role="alert">
                    <svg class="me-3 mt-[2px] inline h-4 w-4 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Waspada</span>
                    <div>
                        <span class="font-medium">Info Penting:</span>
                        <ul class="mt-1.5 list-inside list-disc">
                            <li>Semua penjualan bersifat final. Harap tinjau pesanan Anda dengan cermat sebelum
                                menyelesaikan
                                pembelian.</li>
                            <li>Pastikan alamat pengiriman Anda benar. Kami tidak bertanggung jawab atas barang yang
                                dikirim
                                ke
                                alamat yang salah.</li>
                            <li>Jika Anda perlu membatalkan atau mengubah pesanan, harap hubungi kami dalam waktu 1 jam
                                setelah
                                melakukan pemesanan.</li>
                            <li>Semua informasi pribadi yang diberikan harus akurat dan lengkap untuk menghindari
                                keterlambatan
                                pemrosesan.</li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="flex justify-center space-x-4 py-5">
                <x-button.primary>
                    Checkout
                </x-button.primary>
                <x-button.a-secondary href="{{ route('cart') }}">
                    Kembali
                </x-button.a-secondary>
            </div>
        </form>
    @else
        Nope
    @endif


</div>
