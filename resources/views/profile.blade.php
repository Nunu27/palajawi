<x-app-layout title="Profil">
    {{-- TODO: Profil UI --}}
    <div class="mx-auto max-w-7xl space-x-6 px-6 font-bold lg:px-8">
        <x-nav-link.app route="profile">Data akun</x-nav-link.app>
        <x-nav-link.app route="user.transactions">Histori Transaksi</x-nav-link.app>
    </div>
    <div class="py-6">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <livewire:profile.update-profile-information-form />
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
