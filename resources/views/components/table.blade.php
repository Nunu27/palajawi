@props(['headers', 'data', 'actions', 'columns', 'route'])

@php
    $perPageList = [10, 25, 50, 100];
    if (isset($actions)) {
        $canView = in_array('view', $actions);
        $canEdit = in_array('edit', $actions);
        $canDelete = in_array('delete', $actions);
    } else {
        $canView = false;
        $canEdit = false;
        $canDelete = false;
    }

    $perPage = $data?->perPage() ?? 10;
    $total = $data?->total() ?? 0;
@endphp

<div class="flex h-9 items-center justify-between">
    <div class="flex w-0 items-center gap-2 overflow-hidden text-sm text-gray-700 lg:w-max">
        <select wire:model='perPage' wire:change='refresh' name="per_page" id="perPage"
            class="rounded-md px-2 py-1 pr-6 text-xs">
            @foreach ($perPageList as $perPageCount)
                <option value="{{ $perPageCount }}">{{ $perPageCount }}</option>
            @endforeach
        </select>
        Per halaman
    </div>
    @isset($slot)
        <div class="flex gap-2">{{ $slot }}</div>
    @endisset
</div>
<div class="my-5 w-full overflow-x-auto rounded-lg border" x-data="{
    id: @entangle('id'),
    contextMenuOpen: false,
    contextMenuToggle: function(event, id) {
        this.contextMenuOpen = true;
        this.id = id;
        event.preventDefault();
        this.$refs.contextmenu.classList.add('opacity-0');
        let that = this;
        $nextTick(function() {
            that.calculateContextMenuPosition(event);
            that.calculateSubMenuPosition(event);
            that.$refs.contextmenu.classList.remove('opacity-0');
        });
    },
    calculateContextMenuPosition(clickEvent) {
        if (window.innerHeight < clickEvent.clientY + this.$refs.contextmenu.offsetHeight) {
            this.$refs.contextmenu.style.top = (window.innerHeight - this.$refs.contextmenu.offsetHeight) + 'px';
        } else {
            this.$refs.contextmenu.style.top = clickEvent.clientY + 'px';
        }
        if (window.innerWidth < clickEvent.clientX + this.$refs.contextmenu.offsetWidth) {
            this.$refs.contextmenu.style.left = (clickEvent.clientX - this.$refs.contextmenu.offsetWidth) + 'px';
        } else {
            this.$refs.contextmenu.style.left = clickEvent.clientX + 'px';
        }
    },
    calculateSubMenuPosition(clickEvent) {
        let submenus = document.querySelectorAll('[data-submenu]');
        let contextMenuWidth = this.$refs.contextmenu.offsetWidth;
        for (let i = 0; i < submenus.length; i++) {
            if (window.innerWidth < (clickEvent.clientX + contextMenuWidth + submenus[i].offsetWidth)) {
                submenus[i].classList.add('left-0', '-translate-x-full');
                submenus[i].classList.remove('right-0', 'translate-x-full');
            } else {
                submenus[i].classList.remove('left-0', '-translate-x-full');
                submenus[i].classList.add('right-0', 'translate-x-full');
            }
            if (window.innerHeight < (submenus[i].previousElementSibling.getBoundingClientRect().top + submenus[i].offsetHeight)) {
                let heightDifference = (window.innerHeight - submenus[i].previousElementSibling.getBoundingClientRect().top) - submenus[i].offsetHeight;
                submenus[i].style.top = heightDifference + 'px';
            } else {
                submenus[i].style.top = '';
            }
        }
    }
}" x-init="$watch('contextMenuOpen', function(value) {
    if (value === true) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden') }
});
window.addEventListener('resize', function(event) { contextMenuOpen = false; });">
    <table class="w-full table-auto text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                @foreach ($headers as $key)
                    <th class="px-6 py-4 text-start">{{ $key }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white">
            @forelse ($data?->items() ?? [] as $item)
                <tr @if (isset($actions) && count($actions)) @contextmenu="contextMenuToggle(event, '{{ $item->id }}')" @endif
                    @if ($canView) class="hover:bg-gray-100 cursor-pointer" @else class="hover:bg-gray-100" @endif>
                    @foreach ($columns as $column)
                        <td class="truncate border-t border-gray-200 px-6 py-4">
                            @if (is_array($column))
                                @switch($column[1])
                                    @case('image')
                                        <img src="{{ $item[$column[0]] }}" alt="Gambar"
                                            class="aspect-square w-32 rounded-md border border-gray-300 bg-gray-200 object-cover">
                                    @break

                                    @case('number')
                                        {{ ($column[2] ?? '') . number_format($item[$column[0]], 0, ',', '.') }}
                                    @break

                                    @case('relation')
                                        {{ $item[$column[0]][$column[2]] }}
                                    @break

                                    @default
                                        {{ $item[$column[0]] }}
                                @endswitch
                            @else
                                {{ is_bool($item[$column]) ? ($item[$column] ? 'Iya' : 'Tidak') : $item[$column] }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}"
                            class="h-[25svh] border-t border-gray-200 px-6 py-4 text-center">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <template x-teleport="body">
            <div x-show="contextMenuOpen" @click.away="contextMenuOpen=false" x-ref="contextmenu"
                class="text-md fixed z-50 w-64 min-w-[8rem] rounded-md border border-neutral-200/70 bg-white p-1 text-neutral-800 shadow-md"
                x-cloak>
                @if ($canView)
                    <div @click="contextMenuOpen=false" wire:click='view'
                        class="group relative flex cursor-default select-none items-center rounded px-2 py-1.5 pl-8 outline-none hover:bg-gray-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                        @svg('gmdi-remove-red-eye-o', 'absolute left-2 h-4')
                        <span>Lihat</span>
                    </div>
                @endif
                @if ($canEdit)
                    <div @click="contextMenuOpen=false" wire:click='edit'
                        class="group relative flex cursor-default select-none items-center rounded px-2 py-1.5 pl-8 outline-none hover:bg-gray-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                        @svg('gmdi-edit', 'absolute left-2 h-4')
                        <span>Edit</span>
                    </div>
                @endif
                @if ($canDelete)
                    <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                    <div @click="contextMenuOpen=false; $dispatch('open-modal', 'delete');"
                        class="group relative flex cursor-default select-none items-center rounded px-2 py-1.5 pl-8 text-red-600 outline-none hover:bg-gray-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                        @svg('gmdi-delete-o', 'absolute left-2 h-4')
                        <span>Hapus</span>
                    </div>
                @endif
            </div>
        </template>
    </div>
    @isset($data)
        {{ $data->links() }}
    @endisset
