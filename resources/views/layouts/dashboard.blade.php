@props(['title'])

@php
    $sideBarOpen = isset($_COOKIE['sideBarOpen']) ? $_COOKIE['sideBarOpen'] == 'true' : false;
@endphp

<x-root-layout title="{{ (isset($title) ? $title . ' - ' : '') . 'Dashboard' }}">
    <div class="flex h-screen overflow-y-hidden bg-white" x-cloak x-data="{
        sideBarOpen: {{ $sideBarOpen ? 'true' : 'false' }},
        toggle() {
            this.sideBarOpen = !this.sideBarOpen
            document.cookie = `sideBarOpen=${this.sideBarOpen}; path=/`;
        },
        init() {
            if (window.innerWidth < 1024 && this.sideBarOpen) {
                this.toggle();
            }
        }
    }">
        <!-- Sidebar backdrop -->
        <div x-show.in.out.opacity="sideBarOpen" @click="toggle()"
            class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
            style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

        <!-- Sidebar -->
        <aside x-transition:enter="transition transform duration-300"
            x-transition:enter-start="-translate-x-full opacity-30  ease-in"
            x-transition:enter-end="translate-x-0 opacity-100 ease-out"
            x-transition:leave="transition transform duration-300"
            x-transition:leave-start="translate-x-0 opacity-100 ease-out"
            x-transition:leave-end="-translate-x-full opacity-0 ease-in"
            class="fixed inset-y-0 z-10 flex max-h-screen flex-shrink-0 transform flex-col overflow-hidden border-r bg-white shadow-lg transition-all lg:static lg:z-auto lg:shadow-none"
            :class="{ '-translate-x-full lg:translate-x-0 lg:w-20': !sideBarOpen, 'w-64': true, }">
            <!-- sidebar header -->
            <div class="flex flex-shrink-0 items-center justify-between p-2"
                :class="{ 'lg:justify-center': !sideBarOpen }">
                <span
                    class="flex items-center whitespace-nowrap p-2 text-xl font-semibold uppercase leading-8 tracking-wider">
                    <x-logo class="m-1 h-6 w-6 fill-current text-gray-500" />
                    <span :class="{ 'lg:hidden': !sideBarOpen }" class="ml-2">Palajawi</span>
                </span>
                <button @click="toggle()" class="rounded-md p-2 lg:hidden">
                    <x-gmdi-close-r class="h-6" />
                </button>
            </div>
            <!-- Sidebar links -->
            <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                <ul class="space-y-2 overflow-hidden p-2">
                    <x-nav-link.dashboard icon='gmdi-dashboard-o' iconActive='gmdi-dashboard-r'>
                        Dashboard
                    </x-nav-link.dashboard>
                    <x-nav-link.dashboard route='barang' icon='gmdi-list-alt' iconActive='gmdi-list-alt-tt'>
                        Barang
                    </x-nav-link.dashboard>
                    <x-nav-link.dashboard route='transaksi' icon='gmdi-receipt-long-o'
                        iconActive='gmdi-receipt-long-tt'>
                        Transaksi
                    </x-nav-link.dashboard>
                    <x-nav-link.dashboard route='user' icon='gmdi-people-outline' iconActive='gmdi-people-r'>
                        Pengguna
                    </x-nav-link.dashboard>
                    <!-- Sidebar Links... -->
                </ul>
            </nav>
            <!-- Sidebar footer -->
            <div class="max-h-14 flex-shrink-0 border-t p-2">
                <a href="{{ route('logout') }}"
                    class="flex w-full items-center justify-center space-x-1 rounded-md border bg-gray-100 px-4 py-2 font-medium tracking-wider focus:outline-none focus:ring">
                    <x-gmdi-logout-r class="h-5" />
                    <span :class="{ 'hidden': !sideBarOpen }"> Keluar </span>
                </a>
            </div>
        </aside>

        <div class="flex h-full flex-1 flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="flex-shrink-0 border-b">
                <div class="flex items-center justify-between p-2">
                    <!-- Navbar left -->
                    <div class="flex items-center space-x-3">
                        <button @click="toggle()" class="h-10 w-10 rounded-md p-2 focus:outline-none focus:ring">
                            <div :class="{ 'hidden': !sideBarOpen }">
                                <x-gmdi-close-r class="h-6" />
                            </div>
                            <div :class="{ 'hidden': sideBarOpen }">
                                <x-gmdi-menu-r class="h-6" />
                            </div>
                        </button>
                        <span
                            class="p-2 text-xl font-semibold tracking-wider">{{ isset($title) ? $title : 'Dashboard' }}</span>
                    </div>

                    <!-- avatar button -->
                    <x-auth-button />
            </header>
            <!-- Main content -->
            <main class="max-h-full flex-1 overflow-hidden overflow-y-auto bg-gray-100 p-2 lg:p-5">
                {{ $slot }}
            </main>
            <!-- Main footer -->
            <footer class="flex max-h-14 flex-shrink-0 items-center justify-center border-t p-4 uppercase">
                <div>Palajawi &copy; 2024</div>
            </footer>
        </div>
    </div>
</x-root-layout>
