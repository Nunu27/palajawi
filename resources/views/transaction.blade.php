<x-app-layout title="Detail Transaksi">
    {{-- TODO: Detail transaksi UI --}}
    <div class="container mx-auto my-6 p-4 bg-white rounded-lg shadow-md" style="max-width: 500px;">
        <h3 class="text-xl font-bold mb-4">Checkout Barang</h3>

        <form action="#">
            <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="nama" class="text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm">
            </div>
            <div>
                <label for="email" class="text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm">
            </div>
            <div>
                <label for="alamat" class="text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm"></textarea>
            </div>
            <div>
                <label for="no_telepon" class="text-gray-700 mb-2">Nomor Telepon</label>
                <input type="tel" id="no_telepon" name="no_telepon" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm">
            </div>
            <div>
                <label for="metode_pembayaran" class="text-gray-700 mb-2">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm">
                <option value="">Pilih Metode Pembayaran</option>
                <option value="transfer_bank">Transfer Bank</option>
                <option value="e-wallet">E-Wallet</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Checkout</button>
            </div>
            </div>
        </form>
    </div>
</x-app-layout>
