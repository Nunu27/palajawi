<x-guest-layout>
    <x-form method="POST" action="{{ route('register') }}">
        <!-- Name -->
        <div>
            <x-input-label for="username" value='Nama' />
            <x-text-input class="mt-1 block w-full" type="text" name="username" required autofocus autocomplete="name" />
            <x-input-error name='name' class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <x-input-label for="email" value="Email" />
            <x-text-input class="mt-1 block w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error name='email' class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-input-label for="password" value="Kata sandi" />
            <x-text-input class="mt-1 block w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error name='password' class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input class="mt-1 block w-full" type="password" name="password_confirmation" required
                autocomplete="new-password" />
            <x-input-error name='password_confirmation' class="mt-2" />
        </div>

        <x-button.primary class="my-4 flex w-full justify-center">
            Daftar
        </x-button.primary>
        <span class="flex justify-center text-sm">Sudah punya akun? <a href="{{ route('login') }}"
                class="ms-2 text-blue-600">
                Masuk
            </a>
        </span>
    </x-form>
</x-guest-layout>
