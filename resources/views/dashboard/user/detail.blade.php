<x-dashboard-layout title='Detail Pengguna'>
    <x-button.a-secondary href="{{ route('user.index') }}">Kembali</x-button.a-secondary>
    <div class="my-5 flex flex-col gap-4 lg:flex-row">
        <x-image-upload name='cover' class="max-w-72 aspect-square w-full rounded-md border border-gray-300"
            :placeholder="$user->foto_profil" required disabled />
        <div class="grid flex-1 auto-rows-min gap-4 gap-y-2 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <x-input-label for="nama" value="Username" />
                <x-text-input class="mt-1 block w-full" type="text" name="username" value="{{ $user->username }}"
                    required autofocus disabled />
            </div>
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input class="mt-1 block w-full" type="text" name="email" value="{{ $user->email }}"
                    required autofocus disabled />
            </div>
            <div>
                <x-input-label for="alamat" value="Alamat" />
                <x-text-input class="mt-1 block w-full" type="text" name="alamat" value="{{ $user->alamat }}"
                    required autofocus disabled />
            </div>
            <div>
                <x-input-label for="admin" value="Admin" />
                <x-text-input class="mt-1 block w-full" type="text" name="admin"
                    value="{{ $user->admin ? 'Iya' : 'Tidak' }}" required autofocus disabled />
            </div>
            <div>
                <x-input-label for="created_at" value="Created At" />
                <x-text-input class="mt-1 block w-full" type="text" name="created_at" value="{{ $user->created_at }}"
                    required autofocus disabled />
            </div>
            <div>
                <x-input-label for="updated_at" value="Updated At" />
                <x-text-input class="mt-1 block w-full" type="text" name="updated_at" value="{{ $user->updated_at }}"
                    required autofocus disabled />
            </div>
        </div>
    </div>
</x-dashboard-layout>
