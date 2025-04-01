@props(['user'])

<div class="flex-none hidden lg:block">
    <ul class="menu menu-horizontal gap-2">
        <x-layouts.navbar.novel-link />
        <x-layouts.navbar.category-dropdown />
        @auth
            <x-layouts.navbar.user-dropdown :user="$user" />
        @else
            <x-layouts.navbar.auth-buttons />
        @endauth
    </ul>
</div> 