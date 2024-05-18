@props(['nama'])

<!-- product - start -->
<div class="flex flex-wrap gap-x-4 overflow-hidden rounded-lg border sm:gap-y-4 lg:gap-6">
    <a href="#" class="group relative block h-48 w-32 overflow-hidden bg-gray-100 sm:h-30 sm:w-40">
        <img src="{{ asset('images/potato.png') }}" loading="lazy" alt="Photo by Rachit Tank" loading="lazy"
            alt="Photo by Thái An"
            class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
    </a>

    <div class="flex flex-1 flex-col justify-between py-4">
        <div>
            <a href="#"
                class="mb-1 inline-block text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl">{{ $nama }}</a>

            <span class="block text-gray-500">Kategory: makanan </span>
        </div>
    </div>

    <div class="flex w-full justify-between border-t p-4 sm:w-auto sm:border-none sm:pl-0 lg:p-6 lg:pl-0">
        <div class="flex items-start gap-2">
            <button id="subtactButton "class="rounded-full border w-14">-</button>
            <div id="quantity"> 0 </div>
            <button id="addButton" class="rounded-full border w-14">+</button>
            <span id="totalHarga" class="block font-bold text-gray-800 md:text-lg ml-10">Rp 15.00</span>
        </div>
    </div>
</div>
<!-- product - end -->
