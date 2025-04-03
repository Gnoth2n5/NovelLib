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
        <x-comments.main 
            :route="route('chapters.comments.store', ['novel' => $novel, 'chapter' => $chapter])"
            :comments="$chapter->comments()->with('user')->where('is_hidden', false)->latest()->get()"
        ></x-comments.main>
        
    </div>
</x-guest-layout>
