<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Tiêu đề và bộ lọc -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <h1 class="text-3xl font-bold">Danh Sách Truyện</h1>
            <div class="flex flex-wrap gap-4">
                <select class="select select-bordered w-full md:w-auto" onchange="window.location.href=this.value">
                    <option value="{{ route('novels.index') }}" {{ !request('category') ? 'selected' : '' }}>Tất cả thể loại</option>
                    @foreach(\App\Models\Category::where('is_active', true)->get() as $category)
                        <option value="{{ route('novels.index', ['category' => $category->slug]) }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select class="select select-bordered w-full md:w-auto" onchange="window.location.href=this.value">
                    <option value="{{ route('novels.index') }}" {{ !request('sort') ? 'selected' : '' }}>Mới cập nhật</option>
                    <option value="{{ route('novels.index', ['sort' => 'views']) }}" {{ request('sort') == 'views' ? 'selected' : '' }}>Lượt xem cao</option>
                    <option value="{{ route('novels.index', ['sort' => 'follows']) }}" {{ request('sort') == 'follows' ? 'selected' : '' }}>Theo dõi nhiều</option>
                </select>
            </div>
        </div>

        <!-- Danh sách truyện -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($novels as $novel)
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-4 pt-4">
                        @if($novel->cover_image)
                            <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}" class="rounded-xl h-64 w-full object-cover" />
                        @else
                            <div class="rounded-xl h-64 w-full bg-base-300 flex items-center justify-center">
                                <span class="text-4xl">📚</span>
                            </div>
                        @endif
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ Str::limit($novel->title, 50) }}</h2>
                        <p class="text-sm text-base-content/70">Tác giả: {{ $novel->user->name }}</p>
                        <div class="flex items-center gap-4 text-sm text-base-content/70">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                </svg>
                                {{ number_format($novel->views) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z" clip-rule="evenodd" />
                                </svg>
                                {{ $novel->chapters_count ?? 0 }} chương
                            </span>
                        </div>
                        <div class="flex gap-2 flex-wrap mt-2">
                            @foreach($novel->categories as $category)
                                <a href="{{ route('novels.index', ['category' => $category->slug]) }}" class="badge badge-outline hover:badge-primary">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <a href="{{ route('novels.show', $novel) }}" class="btn btn-primary btn-sm">Đọc ngay</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="mt-8">
            {{ $novels->links() }}
        </div>
    </div>
</x-guest-layout> 