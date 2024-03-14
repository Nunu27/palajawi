@php
    $user = request()->user();
@endphp

@if (isset($user))
    <div class="relative pr-2" x-data="{ isOpen: false }">
        <div class="flex items-center">
            <span class="mr-2">{{ $user->username }}</span>
            <button @click="isOpen = !isOpen" class="flex rounded-full bg-gray-200">
                <x-gmdi-account-circle-r class="h-9" />
            </button>
        </div>
        <!-- Dropdown card -->
        <div @click.away="isOpen = false" x-show.transition.opacity="isOpen"
            class="absolute mt-3 min-w-max -translate-x-full transform rounded-md bg-white shadow-lg">
            <div class="flex flex-col space-y-1 border-b p-4 font-medium">
                <span class="text-gray-800">{{ $user->username }}</span>
                <span class="text-sm text-gray-400">{{ $user->email }}</span>
            </div>
            <ul class="my-2 flex flex-col space-y-1 p-2">
                <li>
                    <a href="#" class="block rounded-md px-2 py-1 transition hover:bg-gray-100">Link</a>
                </li>
            </ul>
            <div class="flex items-center justify-center border-t p-4 text-blue-700 underline">
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
@else
    <div class="hidden gap-3 sm:-my-px sm:ms-10 sm:flex">
        <x-button.a-primary href="{{ route('login') }}">
            Masuk
        </x-button.a-primary>
        <x-button.a-secondary href="{{ route('register') }}">
            Daftar
        </x-button.a-secondary>
    </div>
@endif
