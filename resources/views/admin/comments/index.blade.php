<x-admin-layout>
    <div class="space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Quản lý bình luận</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Truyện/Chương</th>
                                <th>Thời gian</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ Str::limit($comment->content, 50) }}</td>
                                <td>
                                    @if($comment->commentable_type === 'App\Models\Novel')
                                        <a href="{{ route('novels.show', $comment->commentable) }}" class="link link-hover">
                                            {{ $comment->commentable->title }}
                                        </a>
                                    @else
                                        <a href="{{ route('chapters.show', $comment->commentable) }}" class="link link-hover">
                                            Chương {{ $comment->commentable->number }} - {{ $comment->commentable->novel->title }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.comments.delete', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 