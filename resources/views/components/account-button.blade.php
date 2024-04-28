@php
    $user = request()->user();
@endphp

@if (isset($user))
    <div class="relative pr-2" x-data="{ isOpen: false }">
        <div class="flex items-center">
            <span class="mr-2 hidden md:block">{{ $user->username }}</span>
            <button @click="isOpen = !isOpen" class="flex rounded-full bg-gray-200">
                <x-gmdi-account-circle-r class="h-9" />
            </button>
        </div>
        <!-- Dropdown card -->
        <div @click.away="isOpen = false" x-show.transition.opacity="isOpen"
            class="absolute mt-3 min-w-max -translate-x-2/4 transform rounded border bg-white shadow-lg">
            <div class="flex flex-col border-b p-3 font-medium">
                <span class="text-gray-800">{{ $user->username }}</span>
                <span class="text-sm text-gray-400">{{ $user->email }}</span>
            </div>
            <ul class="flex flex-col space-y-1 p-1">
                @if ($user->admin)
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="block rounded px-2 py-1 transition hover:bg-gray-100">Dashboard</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('transaction') }}" class="block rounded px-2 py-1 transition hover:bg-gray-100">
                            Histori Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="{{ ('profile') }}" class="block rounded px-2 py-1 transition hover:bg-gray-100">
                            Edit profile
                        </a>
                    </li>
                @endif
            </ul>
            <div class="border-t p-1 text-red-600">
                <a href="{{ route('logout') }}" class="block rounded px-2 py-1 transition hover:bg-gray-100">Keluar</a>
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
