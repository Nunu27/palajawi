@php
    $user = request()->user();
    $inDashboard = str_starts_with($_SERVER['REQUEST_URI'], '/dashboard');
@endphp

@if (isset($user))
    <div class="flex items-center">
        @if (!$inDashboard)
            <a href="{{ route('cart') }}">
                <x-gmdi-shopping-cart-o class="h-5 text-gray-500" />
            </a>
        @endif
        <x-dropdown>
            <x-slot name="trigger">
                <div class="flex px-3 py-2 text-sm font-medium text-gray-500">
                    <span x-data="{{ json_encode(['username' => $user->username]) }}" x-text="username"
                        x-on:profile-updated.window="username = $event.detail.username"></span>
                    <x-gmdi-keyboard-arrow-down-r class="h-5" />
                </div>
            </x-slot>
            <x-slot name='content'>
                @if ($user->admin)
                    <x-nav-link.dropdown href="{{ route($inDashboard ? 'home' : 'dashboard') }}">
                        {{ $inDashboard ? 'Beranda' : 'Dashboard' }}
                    </x-nav-link.dropdown>
                @endif
                <x-nav-link.dropdown href="{{ route('profile') }}">
                    Profil
                </x-nav-link.dropdown>
                <x-nav-link.dropdown href="{{ route('user.transactions') }}">
                    Histori transaksi
                </x-nav-link.dropdown>
                <x-nav-link.dropdown href="{{ route('logout') }}">
                    Keluar
                </x-nav-link.dropdown>
            </x-slot>
        </x-dropdown>

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
