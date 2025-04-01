@props(['category'])
<div class="badge badge-soft badge-primary">
    <a href="{{ route('novels.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
</div>