@props(['route', 'comments'])


<div class="mt-8">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl mb-6">Bình luận</h2>

            @auth
                <x-comments.comment-form :route="$route"></x-comments.comment-form>
            @endauth

            <x-comments.guest></x-comments.guest>

            <x-comments.comment-item :comments="$comments"></x-comments.comment-item>
        </div>
    </div>
</div>