<x-admin-layout>
    <div class="space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Quản lý truyện</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên truyện</th>
                                <th>Tác giả</th>
                                <th>Thể loại</th>
                                <th>Số chương</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($novels as $novel)
                            <tr>
                                <td>{{ $novel->title }}</td>
                                <td>{{ $novel->user->name }}</td>
                                <td>{{ $novel->categories->pluck('name')->implode(', ') }}</td>
                                <td>{{ $novel->chapters->count() }}</td>
                                <td>
                                    @if($novel->status === 'ongoing')
                                        <span class="badge badge-info">Đang ra</span>
                                    @elseif($novel->status === 'completed')
                                        <span class="badge badge-success">Hoàn thành</span>
                                    @else
                                        <span class="badge badge-warning">Tạm dừng</span>
                                    @endif
                                </td>
                                <td>{{ $novel->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('novels.show', $novel) }}" class="btn btn-sm btn-info">Xem</a>
                                        <form action="{{ route('admin.novels.delete', $novel) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa truyện này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $novels->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 