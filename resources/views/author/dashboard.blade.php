<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Thống kê tổng số truyện -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Tổng số truyện</h2>
                    <p class="text-3xl font-bold">{{ $stats['total_novels'] }}</p>
                </div>
            </div>

            <!-- Thống kê tổng số chương -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Tổng số chương</h2>
                    <p class="text-3xl font-bold">{{ $stats['total_chapters'] }}</p>
                </div>
            </div>

            <!-- Thống kê lượt xem -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Lượt xem</h2>
                    <p class="text-3xl font-bold">{{ number_format($stats['total_views']) }}</p>
                </div>
            </div>

            <!-- Thống kê lượt theo dõi -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Lượt theo dõi</h2>
                    <p class="text-3xl font-bold">{{ number_format($stats['total_follows']) }}</p>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="card-title">Danh sách truyện</h2>
                    <a href="{{ route('author.novels.create') }}" class="btn btn-primary">Thêm truyện mới</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Số chương</th>
                                <th>Lượt xem</th>
                                <th>Lượt theo dõi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($novels as $novel)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            @if($novel->cover_image)
                                                <img src="{{ Storage::url($novel->cover_image) }}" 
                                                     alt="{{ $novel->title }}" 
                                                     class="w-12 h-16 object-cover rounded" />
                                            @endif
                                            <div>
                                                <div class="font-bold">{{ Str::limit($novel->title, 35, '...') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $novel->chapters->count() }}</td>
                                    <td>{{ number_format($novel->views) }}</td>
                                    <td>{{ number_format($novel->follows) }}</td>
                                    <td>
                                        @if($novel->status === 'ongoing')
                                            <span class="badge badge-warning">Đang tiến hành</span>
                                        @elseif($novel->status === 'completed')
                                            <span class="badge badge-success">Đã hoàn thành</span>
                                        @else
                                            <span class="badge badge-error">Tạm ngưng</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('author.novels.edit', $novel) }}" class="btn btn-sm">Xem và Sửa</a>
                                            <a href="{{ route('author.chapters.index', $novel) }}" class="btn btn-sm btn-primary">Thêm chương</a>
                                            <form action="{{ route('author.novels.destroy', $novel) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Bạn có chắc chắn muốn xóa truyện này?')">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Chưa có truyện nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 