<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;

new class extends Component {
    use WithFileUploads, Toastable;

    public $foto;
    public ?string $foto_profil;
    public string $email = '';
    public string $username = '';
    public string $alamat = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->email = Auth::user()->email;
        $this->username = Auth::user()->username;
        $this->foto_profil = Auth::user()->foto_profil;
        $this->alamat = Auth::user()->alamat ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $this->validate([
            'foto' => ['image,max:1024'],
        ]);

        $user = Auth::user();

        if ($this->foto) {
            $this->foto_profil = 'https://palajawi.s3.ap-southeast-1.amazonaws.com/' . $this->foto->storePubliclyAs('foto_profil', $user->id, 's3');
        }

        $user->castAndFill([
            'username' => $this->username,
            'foto_profil' => $this->foto_profil,
            'alamat' => $this->alamat,
        ]);
        $user->save();
        $this->success('Data akun berhasil diubah');
        $this->dispatch('profile-updated', username: $user->username);
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div class="flex flex-col items-center gap-6 lg:flex-row lg:items-start">
            <x-image-upload name='foto' :data="$foto" alt='Foto profil' :placeholder="$foto_profil"
                class="max-w-56 aspect-square w-full overflow-hidden rounded-full border border-gray-300 bg-gray-200" />
            <div class="w-full flex-1">
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" name="email" type="email"
                        class="mt-1 block w-full" required autocomplete="username" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-input-label for="username" :value="__('Name')" />
                    <x-text-input wire:model="username" id="username" name="username" type="text"
                        class="mt-1 block w-full" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                </div>

                <div>
                    <x-input-label for="alamat" value="Alamat" />
                    <x-text-area wire:model="alamat" id="alamat" name="alamat" type="text"
                        class="mt-1 block w-full" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-button.primary>{{ __('Save') }}</x-button.primary>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
