@php
    $user = request()->user();
@endphp

<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 md:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex h-full">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-4 whitespace-nowrap text-xl font-semibold uppercase">
                    <x-logo class="block h-9 w-auto fill-current text-gray-800" />
                    Palajawi
                </a>
                <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                    <x-nav-link.app route="home">
                        Beranda
                    </x-nav-link.app>
                    <x-nav-link.app route="filter">
                        Filter
                    </x-nav-link.app>
                </div>
            </div>

            <livewire:search-bar />

            <div class="hidden md:flex">
                <x-auth-button />
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                    <div :class="{ 'hidden': !open }">
                        <x-gmdi-close-r class="h-6" />
                    </div>
                    <div :class="{ 'hidden': open }">
                        <x-gmdi-menu-r class="h-6" />
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-nav-link.responsive route="dashboard">
                Dashboard
            </x-nav-link.responsive>
            <x-nav-link.responsive route="dashboard">
                Filter
            </x-nav-link.responsive>
        </div>

        <!-- Responsive Settings Options -->
        <div class="space-y-1 border-t border-gray-200 py-3">
            @if (isset($user))
                <x-nav-link.responsive route="profile">
                    <div class="text-base font-medium text-gray-800" x-data="{{ json_encode(['username' => $user->username]) }}" x-text="username"
                        x-on:profile-updated.window="username = $event.detail.username">
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ $user->email }}
                    </div>
                </x-nav-link.responsive>
                <x-nav-link.responsive route="dashboard">
                    Dashboard
                </x-nav-link.responsive>
                <x-nav-link.responsive route="cart">
                    Keranjang
                </x-nav-link.responsive>
                <x-nav-link.responsive route="user.transactions">
                    Histori Transaksi
                </x-nav-link.responsive>
                <x-nav-link.responsive route="logout">
                    Keluar
                </x-nav-link.responsive>
            @else
                <div class="mx-4 flex gap-2">
                    <x-button.a-primary href="{{ route('login') }}">
                        Masuk
                    </x-button.a-primary>
                    <x-button.a-secondary href="{{ route('register') }}">
                        Daftar
                    </x-button.a-secondary>
                </div>
            @endif
        </div>
    </div>
</nav>
