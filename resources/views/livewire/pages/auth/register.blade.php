<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Daftar')] class extends Component {
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate(['email' => ['unique:users'], 'password' => ['confirmed']]);
        event(
            new Registered(
                ($user = User::castAndCreate([
                    'username' => $this->username,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ])),
            ),
        );

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="username" :value="__('Name')" />
            <x-text-input wire:model="username" id="username" class="mt-1 block w-full" type="text" name="username"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="mt-1 block w-full" type="email" name="email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="mt-1 block w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="mt-1 block w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-button.primary class="my-4 flex w-full justify-center">
            Daftar
        </x-button.primary>
        <span class="flex justify-center text-sm">Sudah punya akun? <a href="{{ route('login') }}"
                class="ms-2 text-blue-600">
                Masuk
            </a>
        </span>
    </form>
</div>
