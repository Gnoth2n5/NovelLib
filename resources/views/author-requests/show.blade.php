<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h1 class="card-title text-2xl mb-6">Chi tiết yêu cầu tác giả</h1>

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div>
                            <h3 class="font-semibold">Người dùng</h3>
                            <p>{{ $authorRequest->user->name }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold">Lý do</h3>
                            <p class="whitespace-pre-wrap">{{ $authorRequest->reason }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold">Trạng thái</h3>
                            @if($authorRequest->status === 'pending')
                                <span class="badge badge-warning">Đang chờ</span>
                            @elseif($authorRequest->status === 'approved')
                                <span class="badge badge-success">Đã duyệt</span>
                            @else
                                <span class="badge badge-error">Đã từ chối</span>
                            @endif
                        </div>

                        @if($authorRequest->admin_note)
                            <div>
                                <h3 class="font-semibold">Ghi chú của admin</h3>
                                <p class="whitespace-pre-wrap">{{ $authorRequest->admin_note }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="font-semibold">Thời gian</h3>
                            <p>Ngày tạo: {{ $authorRequest->created_at->format('d/m/Y H:i') }}</p>
                            <p>Cập nhật lần cuối: {{ $authorRequest->updated_at->format('d/m/Y H:i') }}</p>
                        </div>

                        @if($authorRequest->status === 'pending')
                            <div class="flex gap-2 mt-6">
                                <form action="{{ route('admin.author-requests.approve', $authorRequest) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Duyệt</button>
                                </form>
                                <form action="{{ route('admin.author-requests.reject', $authorRequest) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-error">Từ chối</button>
                                </form>
                                <a href="{{route('admin.author-requests.index')}}" class="btn btn-info">Quay lại</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 