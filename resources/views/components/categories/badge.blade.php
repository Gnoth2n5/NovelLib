@props(['category'])

<a href="{{ route('novels.index', ['category' => $category->slug]) }}">
    <span class="badge badge-soft badge-primary">{{ $category->name }}</span>
</a>
