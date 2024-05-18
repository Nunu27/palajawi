<x-app-layout title="Detail Transaksi">
    <div class="heading font-semibold text-2xl mb-4">Checkout Belanja</div>
    <div class="flex">
        <div class="container w-1/2 h-auto mr-4 p-4 bg-white shadow-md rounded-lg">
            <div class="container flex">
                <div>
                    <img src="https://images.unsplash.com/photo-1635264685671-739e75e73e0f?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="gambar produk" class="object-cover w-64 h-48 rounded-lg">
                </div>
                <div class="mx-4 ">
                    <div class="font-semibold text-2xl">MIE AYAM</div>
                    <div class="text-xl text-gray-400">Kategory : makanan</div>
                </div>

            </div>
            <div class="py-4 font-semibold">Detail Pesanan</div>
            <div class=" py-4 border-y border-gray-400">
                <div class="flex">
                    <div class="w-4/6">
                        <div class="">Jumlah barang</div>
                        <div class="">Harga Produk</div>
                        <div class="">Pengiriman</div>
                        <div class="">Metode Pembayaran</div>
                    </div>
                    <div class="w-2/6">
                        <div class="">1</div>
                        <div class="">55.000</div>
                        <div class="">Kargo</div>
                        <div class="">Transfer Bank</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container w-1/2 h-auto ml-4 p-4 bg-white shadow-md rounded-lg">
            <div class="font-semibold text-xl mb-4">Ringkasan Belanja</div>
            <div class="container border-y">
                <div class="container my-4">
                    <div class="font-medium">Total Belanja</div>
                    <div class="flex">
                        <div class="conatiner w-4/6">
                            <div class="font-light text-gray-400">Total Barang</div>
                            <div class="font-light text-gray-400">Ongkos Kirim</div>
                        </div>
                        <div class="container w-2/6">
                            <div class="font-light text-gray-400">Rp 55.000</div>
                            <div class="font-light text-gray-400">Rp 10.000</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conatainer border-y">
                <div class="container my-4">
                    <div class="font-medium">Biaya Transaksi</div>
                    <div class="flex">
                        <div class="conatiner w-4/6">
                            <div class="font-light text-gray-400">Biaya Layanan</div>
                            <div class="font-light text-gray-400">Biya Aplikasi</div>
                        </div>
                        <div class="container w-2/6 ">
                            <div class="font-light text-gray-400">Rp 3.000</div>
                            <div class="font-light text-gray-400">Rp 1.000</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="container w-4/6">
                    <div class="font-semibold text-xl mt-4">Total Tagihan</div>
                </div>
                <div class="container w-2/6">
                    <div class="font-semibold text-xl mt-4">Rp 69.000</div>
                </div>
            </div>
            <button class="w-full border rounded-lg py-2 mt-8 bg-green-400">Bayar</button>
        </div>
    </div>
</x-app-layout>
