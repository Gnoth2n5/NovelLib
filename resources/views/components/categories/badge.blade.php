@props(['category'])
<div class="badge badge-soft badge-primary hover:bg-primary hover:text-white transition">
    <a href="{{ route('novels.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
</div>