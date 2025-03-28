@props(['class' => ''])

<aside {{ $attributes->merge(['class' => 'bg-base-100 w-72 min-h-screen border-r ' . $class]) }}>
    <div class="p-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mb-6 font-bold gap-3 px-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-lg">NovelLib</span>
        </a>

        <x-admin.sidebar.navigation />
    </div>
</aside> 