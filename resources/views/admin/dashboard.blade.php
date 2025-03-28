<x-admin-layout>
    <div class="space-y-6">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Tổng người dùng</div>
                    <div class="stat-value">{{ $stats['total_users'] }}</div>
                    <div class="stat-desc">{{ $stats['total_authors'] }} tác giả</div>
                </div>
            </div>

            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Tổng truyện</div>
                    <div class="stat-value">{{ $stats['total_novels'] }}</div>
                    <div class="stat-desc">{{ $stats['total_chapters'] }} chương</div>
                </div>
            </div>

            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Tổng bình luận</div>
                    <div class="stat-value">{{ $stats['total_comments'] }}</div>
                    <div class="stat-desc">{{ $stats['total_categories'] }} thể loại</div>
                </div>
            </div>
        </div>

        <!-- Latest Users -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Người dùng mới nhất</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Ngày tham gia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Latest Novels -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Truyện mới nhất</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên truyện</th>
                                <th>Tác giả</th>
                                <th>Ngày đăng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_novels as $novel)
                            <tr>
                                <td>{{ $novel->title }}</td>
                                <td>{{ $novel->user->name }}</td>
                                <td>{{ $novel->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Latest Comments -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Bình luận mới nhất</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Truyện/Chương</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_comments as $comment)
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ Str::limit($comment->content, 50) }}</td>
                                <td>
                                    @if($comment->commentable_type === 'App\Models\Novel')
                                        {{ $comment->commentable->title }}
                                    @else
                                        Chương {{ $comment->commentable->number }}
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 