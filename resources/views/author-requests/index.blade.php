<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h1 class="card-title text-2xl mb-6">Quản lý yêu cầu tác giả</h1>

                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Người dùng</th>
                                    <th>Lý do</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($authorRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ Str::limit($request->reason, 100) }}</td>
                                        <td>
                                            @if($request->status === 'pending')
                                                <span class="badge badge-warning">Đang chờ</span>
                                            @elseif($request->status === 'approved')
                                                <span class="badge badge-success">Đã duyệt</span>
                                            @else
                                                <span class="badge badge-error">Đã từ chối</span>
                                            @endif
                                        </td>
                                        <td>{{ $request->admin_note ?? 'Chưa có' }}</td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($request->status === 'pending')
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.author-requests.approve', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">Duyệt</button>
                                                    </form>
                                                    <form action="{{ route('admin.author-requests.reject', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-error">Từ chối</button>
                                                    </form>
                                                </div>
                                            @endif
                                            <a href="{{ route('admin.author-requests.show', $request) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Chưa có yêu cầu tác giả nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 