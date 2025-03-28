@php
    $chapters = $novel->chapters()->orderBy('chapter_number')->get();
    $currentChapter = $chapter->chapter_number;
@endphp
<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs mb-8">
            <ul>
                <li><a href="{{ route('novels.index') }}">Truyện</a></li>
                <li><a href="{{ route('novels.show', $novel) }}">{{ $novel->title }}</a></li>
                <li>Chương {{ $currentChapter }}: {{ $chapter->title }}</li>
            </ul>
        </div>

        <!-- Điều hướng chương -->
        <div class="flex justify-between items-center mb-8">
            @if($prevChapter)
                <a href="{{ route('chapters.show', [$novel, $prevChapter]) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </a>
            @else
                <button class="btn btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </button>
            @endif

            <div class="dropdown">
                <label tabindex="0" class="btn m-1">Chương {{ $currentChapter }}</label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 max-h-96 overflow-y-auto">
                    @foreach($chapters as $ch)
                        <li>
                            <a href="{{ route('chapters.show', [$novel, $ch]) }}" class="{{ $ch->id === $chapter->id ? 'active' : '' }}">
                                Chương {{ $ch->chapter_number }}: {{ Str::limit($ch->title, 30) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if($nextChapter)
                <a href="{{ route('chapters.show', [$novel, $nextChapter]) }}" class="btn btn-primary">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                <button class="btn btn-disabled">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Nội dung chương -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="card-title text-2xl mb-4">Chương {{ $currentChapter }}: {{ $chapter->title }}</h1>
                <div class="prose max-w-none">
                    {!! nl2br(e($chapter->content)) !!}
                </div>
            </div>
        </div>

        <!-- Điều hướng chương (dưới) -->
        <div class="flex justify-between items-center mt-8">
            @if($prevChapter)
                <a href="{{ route('chapters.show', [$novel, $prevChapter]) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </a>
            @else
                <button class="btn btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </button>
            @endif

            <a href="{{ route('novels.show', $novel) }}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Về trang truyện
            </a>

            @if($nextChapter)
                <a href="{{ route('chapters.show', [$novel, $nextChapter]) }}" class="btn btn-primary">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                <button class="btn btn-disabled">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Bình luận -->
        @auth
            <div class="card bg-base-100 shadow-xl mt-8">
                <div class="card-body">
                    <h2 class="card-title mb-4">Bình luận</h2>
                    <form action="{{ route('chapters.comments.store', [$novel, $chapter]) }}" method="POST">
                        @csrf
                        <div class="form-control">
                            <textarea class="textarea textarea-bordered h-24" name="content" placeholder="Nhập bình luận của bạn"></textarea>
                        </div>
                        <div class="form-control mt-4">
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth

        <div class="space-y-4 mt-8">
            @foreach($chapter->comments()->with('user')->latest()->get() as $comment)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-bold">{{ $comment->user->name }}</h3>
                                <p class="text-sm text-base-content/70">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                            @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin')))
                                <form action="{{ route('chapters.comments.destroy', [$novel, $chapter, $comment]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="mt-2">{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout> 