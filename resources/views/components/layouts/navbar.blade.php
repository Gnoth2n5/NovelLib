@props(['user'])

<div class="w-full navbar bg-base-300">
    <x-layouts.navbar.mobile-menu-button />
    <x-layouts.navbar.logo />
    <x-layouts.navbar.desktop-menu :user="$user" />
</div> 