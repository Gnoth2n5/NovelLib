@props(['route', 'title', 'icon'])

<li>
    <a href="{{ route($route) }}" 
       class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs($route) ? 'bg-base-200 font-medium' : 'hover:bg-base-200' }}"
    >
        <span class="w-5 h-5">
            {!! $icon !!}
        </span>
        <span class="ml-3">{{ $title }}</span>
    </a>
</li> 