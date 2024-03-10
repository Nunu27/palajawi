@props(['href', 'route', 'active', 'icon', 'iconActive'])

@php
    $href = $href ?? isset($route) ? route($route) : '';
    $active = $active ?? isset($route) ? request()->routeIs($route) : false;
    $currentIcon = $active && $iconActive ? $iconActive : $icon;
@endphp

<li>
    <a href="{{ $href }}"
        class="{{ $active ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }} flex items-center space-x-2 rounded-md p-2"
        :class="{ 'justify-center': !sideBarOpen, }">
        @svg($currentIcon, 'h-6')
        <span :class="{ 'hidden': !sideBarOpen }">{{ $slot }}</span>
    </a>
</li>
