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
            @if ($prevChapter)
                <a href="{{ route('chapters.show', [$novel, $prevChapter]) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </a>
            @else
                <button class="btn btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </button>
            @endif

            <div class="dropdown">
                <label tabindex="0" class="btn m-1">Chương {{ $currentChapter }}</label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 max-h-96 overflow-y-auto">
                    @foreach ($chapters as $ch)
                        <li>
                            <a href="{{ route('chapters.show', [$novel, $ch]) }}"
                                class="{{ $ch->id === $chapter->id ? 'active' : '' }}">
                                Chương {{ $ch->chapter_number }}: {{ Str::limit($ch->title, 30) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if ($nextChapter)
                <a href="{{ route('chapters.show', [$novel, $nextChapter]) }}" class="btn btn-primary">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                <button class="btn btn-disabled">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
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
            @if ($prevChapter)
                <a href="{{ route('chapters.show', [$novel, $prevChapter]) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </a>
            @else
                <button class="btn btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Chương trước
                </button>
            @endif

            <a href="{{ route('novels.show', $novel) }}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Về trang truyện
            </a>

            @if ($nextChapter)
                <a href="{{ route('chapters.show', [$novel, $nextChapter]) }}" class="btn btn-primary">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                <button class="btn btn-disabled">
                    Chương sau
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Bình luận -->

        <div class="mt-8">
            <div class="card bg-base-100 shadow-xl mt-8">
                <div class="card-body">
                    <h2 class="card-title mb-4">Bình luận</h2>
                    @auth
                        <form action="{{ route('chapters.comments.store', [$novel, $chapter]) }}" method="POST">
                            @csrf
                            <div class="form-control">
                                <textarea class="textarea textarea-bordered h-24 w-full" name="content" placeholder="Nhập bình luận của bạn"></textarea>
                            </div>
                            <div class="form-control mt-4">
                                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                            </div>
                        </form>
                    @endauth
                </div>


                @php
                    $comments = $chapter->comments()->with('user')->latest()->get();
                @endphp

                @if ($comments->isEmpty())
                    <div class="text-center py-8 text-base-content/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 opacity-50"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-lg">Chưa có bình luận nào</p>
                        @guest
                            <p class="mt-2">
                                <a href="{{ route('login') }}" class="link link-primary">Đăng nhập</a>
                                để bình luận
                            </p>
                        @endguest
                    </div>
                @else
                    <div class="space-y-4 mt-8">
                        @foreach ($chapter->comments()->with('user')->latest()->get() as $comment)
                            <div class="card bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="font-bold">{{ $comment->user->name }}</h3>
                                            <p class="text-sm text-base-content/70">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @if (auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin')))
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
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
                @endif
            </div>
        </div>
</x-guest-layout>
