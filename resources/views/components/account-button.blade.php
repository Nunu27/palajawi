<div class="relative pr-2" x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" class="rounded-full bg-gray-200">
        <x-gmdi-account-circle-r class="h-9" />
    </button>
    <!-- Dropdown card -->
    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen"
        class="absolute mt-3 min-w-max -translate-x-full transform rounded-md bg-white shadow-lg">
        <div class="flex flex-col space-y-1 border-b p-4 font-medium">
            <span class="text-gray-800">Nama</span>
            <span class="text-sm text-gray-400">email@example.com</span>
        </div>
        <ul class="my-2 flex flex-col space-y-1 p-2">
            <li>
                <a href="#" class="block rounded-md px-2 py-1 transition hover:bg-gray-100">Link</a>
            </li>
        </ul>
        <div class="flex items-center justify-center border-t p-4 text-blue-700 underline">
            <a href="#">Logout</a>
        </div>
    </div>
</div>
