<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="card-title">Danh sách chương của: {{ $novel->title }}</h2>
                        <p class="text-sm opacity-70">Tổng số chương: {{ $chapters->count() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('author.dashboard') }}" class="btn">Quay lại</a>
                        <a href="{{ route('author.chapters.create', $novel) }}" class="btn btn-primary">Thêm chương mới</a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Số chương</th>
                                <th>Tiêu đề</th>
                                <th>Lượt xem</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($chapters as $chapter)
                                <tr>
                                    <td>{{ $chapter->chapter_number }}</td>
                                    <td>
                                        <div class="font-bold">{{ $chapter->title }}</div>
                                        <div class="text-sm opacity-50">{{ Str::limit(strip_tags($chapter->content), 100) }}</div>
                                    </td>
                                    <td>{{ number_format($chapter->views) }}</td>
                                    <td>
                                        @if($chapter->is_published)
                                            <span class="badge badge-success">Đã xuất bản</span>
                                        @else
                                            <span class="badge badge-warning">Nháp</span>
                                        @endif
                                    </td>
                                    <td>{{ $chapter->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('author.chapters.publish', [$novel, $chapter]) }}" class="btn btn-sm btn-primary">Đăng tải</a>
                                            <a href="{{ route('author.chapters.edit', [$novel, $chapter]) }}" class="btn btn-sm">Sửa</a>
                                            <form action="{{ route('author.chapters.destroy', [$novel, $chapter]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Bạn có chắc chắn muốn xóa chương này?')">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có chương nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 