@props(['comments'])

@if ($comments->isEmpty())
    <div class="text-center py-8 text-base-content/70">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 opacity-50" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                clip-rule="evenodd" />
        </svg>
        <p class="text-lg">Chưa có bình luận nào</p>
    </div>
@else
    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="card bg-base-200 shadow">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold">{{ $comment->user->name }}</h3>
                            <p class="text-sm text-base-content/70">
                                {{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        @if (auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin')))
                            <div class="flex gap-2">
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error"
                                        onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="mt-2 prose max-w-none">
                        {!! nl2br(e($comment->content)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
