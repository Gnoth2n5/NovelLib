@props(['novel'])
<div class="card bg-base-100 shadow-xl">
    <figure class="px-4 pt-4">
        @if ($novel->cover_image)
            <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                class="rounded-xl h-64 w-full object-cover" />
        @else
            <div class="rounded-xl h-64 w-full bg-base-300 flex items-center justify-center">
                <span class="text-4xl">📚</span>
            </div>
        @endif
    </figure>
    <div class="card-body">
        <h2 class="card-title">{{ Str::limit($novel->title, 50) }}</h2>
        <div class="flex items-center gap-2 text-sm text-base-content/70">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                <path fill-rule="evenodd"
                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                    clip-rule="evenodd" />
            </svg>
            {{ number_format($novel->views) }}
        </div>
        <div class="flex gap-2 flex-wrap mt-2">
            @foreach ($novel->categories->take(3) as $category)
                <x-categories.badge :category="$category" />
            @endforeach
        </div>
        <div class="card-actions justify-end mt-4">
            <a href="{{ route('novels.show', $novel) }}" class="btn btn-primary btn-sm">Đọc ngay</a>
        </div>
    </div>
</div>
