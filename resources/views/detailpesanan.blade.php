<x-app-layout title="DetailPesanan">
    <div class="min-w-5-5 mx-5s">
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-3xl font-bold">Pesanan anda</h1>
            <div class="justify-between"></div>
        </div>
        <div class="flex justify-between">
            <p class="text-sm text-gray-700 mb-4">Periksa status pesanan terbaru anda dengan cermat</p>
            <div class="text-sm text-gray-700 font-semibold">Total Amount Rp. 16.000</div>
        </div>
        <div class="mx-auto max-w-full space-y-2 rounded-md bg-white px-8 py-8 shadow-lg sm:flex sm:items-center sm:space-x-6 sm:space-y-0 sm:py-4">
            <div class="text-left sm:text-left items-center justify-around w-full">
                <div class="mb-2 gap-10 flex items-center mx-1">
                    <img class="float-left w-32 h-32 rounded border object-cover" src="https://asset.kompas.com/crops/W7de5aOAnsWp-t-G2oVNEe5yNgo=/77x24:477x291/1200x800/data/photo/2023/02/15/63ec97aa28ed5.jpg" alt="ubi ungu" style="width: 128px; height: 128px;" />
                    <div>
                        <h2 class="text-lg font-bold">Ubi ungu asli madura</h2>
                        <p class="text-sm font-thin my-1">Harga: Rp. 16.000</p>
                            <p class="text-sm font-thin my-1">Jumlah: 1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" py-4 min-w-5-5 mx-5s">
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-xl font-bold">Silakan isi data pribadi Anda di bawah ini!</h1>
            <div class="justify-between"></div>
        </div>
            <p class="text-sm text-gray-700 mb-4">Silakan isi data pribadi Anda di bawah ini dengan cermat!</p>
    </div>
    <div class="mx-auto max-w-full space-y-2 rounded-md bg-white px-8 py-8 shadow-lg sm:flex sm:items-center sm:space-x-6 sm:space-y-0 sm:py-4">
        <div class="text-left sm:text-left items-center justify-around w-full">
           <h1 class="text-sm flex text-black-700 mb-4">Alamat</h1> 
           <div class="w-full max-h-full max-w-full">
            <input type="text" placeholder="Jl. soekarno" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
        </div>
        </div>
        <div class="text-left sm:text-left items-center justify-around w-full">
            <h1 class="text-sm flex text-black-700 mb-4">Metode Pembayaran</h1>
            <div class="w-full max-h-full max-w-full">
                <select class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                    <option value="" disabled selected>Pilih metode pembayaran</option>
                    <option value="transfer">Transfer</option>
                    <option value="cod">COD</option>
                </select>
            </div>
        </div>
        
    </div>
    

    <div class="py-5">
       
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Waspada</span>
            <div>
                <span class="font-medium">Info Penting:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    <li>Semua penjualan bersifat final. Harap tinjau pesanan Anda dengan cermat sebelum menyelesaikan pembelian.</li>
                    <li>Pastikan alamat pengiriman Anda benar. Kami tidak bertanggung jawab atas barang yang dikirim ke alamat yang salah.</li>
                    <li>Jika Anda perlu membatalkan atau mengubah pesanan, harap hubungi kami dalam waktu 1 jam setelah melakukan pemesanan.</li>
                    <li>Semua informasi pribadi yang diberikan harus akurat dan lengkap untuk menghindari keterlambatan pemrosesan.</li>

                </ul>
            </div>
        </div>
    </div>
    
  
  <div class="py-5 flex justify-center space-x-4">
    <button type="button" class="inline-flex items-center justify-center px-20 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-black border rounded-md text-white hover:text-white border-neutral-200/70 active:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
        Checkout Now!
    </button>
    <button type="button" class="inline-flex items-center justify-center px-20 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-red-500 border rounded-md text-white hover:text-white border-neutral-200/70 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
        Cancel
    </button>
</div>

    

</x-app-layout>
