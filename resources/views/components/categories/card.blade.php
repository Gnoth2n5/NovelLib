@props(['category'])

<a href="{{ route('novels.index', ['category' => $category->slug]) }}"
    class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
    <div class="card-body items-center text-center">
        <h3 class="card-title">{{ $category->name }}</h3>
        <p class="text-sm text-base-content/70">
            {{ \App\Models\Novel::whereHas('categories', function ($query) use ($category) {$query->where('categories.id', $category->id);})->count() }}
            truyện</p>
    </div>
</a>