<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex">
                <a href="{{ route('home') }}">
                    <x-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link.app route="home">
                        Beranda
                    </x-nav-link.app>
                    <x-nav-link.app route="filter">
                        Filter
                    </x-nav-link.app>
                </div>
            </div>

            <x-account-button />

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-nav-link.responsive route="dashboard">
                Dashboard
            </x-nav-link.responsive>
            <x-nav-link.responsive route="dashboard">
                Filter
            </x-nav-link.responsive>
        </div>

        <!-- Responsive Settings Options -->
        <div class="flex gap-1 border-t border-gray-200 p-4">
            <x-button.a-primary href="{{ route('login') }}">
                Masuk
            </x-button.a-primary>
            <x-button.a-secondary href="{{ route('register') }}">
                Daftar
            </x-button.a-secondary>
        </div>
    </div>
</nav>
