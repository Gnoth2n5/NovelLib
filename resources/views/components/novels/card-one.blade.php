@props(['novel'])
<div class="card bg-base-100 shadow-xl">
    <figure class="px-4 pt-4">
        @if($novel->cover_image)
            <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}" class="rounded-xl h-64 w-full object-cover" />
        @else
            <div class="rounded-xl h-64 w-full bg-base-300 flex items-center justify-center">
                <span class="text-4xl">📚</span>
            </div>
        @endif
    </figure>
    <div class="card-body">
        <h2 class="card-title">{{ Str::limit($novel->title, 50) }}</h2>
        <p class="text-sm text-base-content/70">Người đăng: {{ $novel->user->name }}</p>
        <div class="flex gap-2 flex-wrap mt-2">
            @foreach($novel->categories->take(3) as $category)
                <x-categories.badge :category="$category" />
            @endforeach
        </div>
        <div class="card-actions justify-end mt-4">
            <a href="{{ route('novels.show', $novel) }}" class="btn btn-primary btn-sm">Đọc ngay</a>
        </div>
    </div>
</div>