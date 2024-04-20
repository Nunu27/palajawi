<x-guest-layout title="Masuk">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-form method="POST" action="{{ route('login') }}">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input class="mt-1 block w-full" type="email" name="email" required autofocus
                autocomplete="username" />
            <x-input-error name='email' class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-input-label for="password" value="Password" />
            <x-text-input class="mt-1 block w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error name="password" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <label for="remember_me" class="mt-2 inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
        </label>

        <x-button.primary class="mb-4 mt-2 flex w-full justify-center">
            Masuk
        </x-button.primary>
        <span class="flex justify-center text-sm">Belum punya akun? <a href="{{ route('register') }}"
                class="ms-2 text-blue-600">
                Daftar
            </a>
        </span>
    </x-form>
</x-guest-layout>
