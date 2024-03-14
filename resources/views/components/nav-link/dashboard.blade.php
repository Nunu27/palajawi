@props(['route', 'active', 'icon', 'iconActive'])

@php
    $name = isset($route) ? $route . '.index' : 'dashboard';
    $current = request()->route()->getName();
    $active = str_starts_with($current, $route ?? 'dashboard');
    $currentIcon = $active && $iconActive ? $iconActive : $icon;
@endphp

<li>
    <a href="{{ route($name) }}"
        class="{{ $active ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }} flex items-center space-x-2 rounded-md p-2"
        :class="{ 'justify-center': !sideBarOpen, }">
        @svg($currentIcon, 'h-6')
        <span :class="{ 'hidden': !sideBarOpen }">{{ $slot }}</span>
    </a>
</li>
