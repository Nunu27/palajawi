@props(['keys', 'data', 'actions'])

@php
    if (isset($actions)) {
        array_push($keys, 'Aksi');
    }
@endphp

<div class="flex items-center justify-between">
    <span class="hidden lg:block">Menampilkan 0-0 dari 1000</span>
    <span class="lg:hidden">0-0 / 1000</span>
    <div class="flex gap-2">{{ $slot }}</div>
</div>
<div class="my-5 overflow-hidden rounded-lg border">
    <table class="w-full table-fixed">
        <thead class="text-gray-800">
            <tr>
                @foreach ($keys as $key)
                    <td class="bg-gray-100 p-2 px-6 py-4 font-bold">{{ $key }}</td>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white">
            @if (isset($data) ? $data->count() > 0 : false)
                @foreach ($data as $item)
                    <tr>
                        @foreach ($item as $value)
                            <td class="border-t border-gray-200 px-6 py-4">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
                @if (count($actions) > 0)
                    <td class="border-t border-gray-200 px-6 py-4">
                        @foreach ($actions as $action)
                            @switch($action)
                                @case('view')
                                    <x-button.a-primary>Lihat</x-button.a-primary>
                                @break

                                @case('edit')
                                    <x-button.a-primary>Edit</x-button.a-primary>
                                @break

                                @case('delete')
                                    <x-button.a-primary>Hapus</x-button.a-primary>
                                @break

                                @default
                            @endswitch
                        @endforeach
                    </td>
                @endif
            @else
                <tr>
                    <td colspan="{{ count($keys) }}" class="h-[25svh] border-t border-gray-200 px-6 py-4 text-center">
                        Belum ada data
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
