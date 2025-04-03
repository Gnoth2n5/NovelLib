<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Tiêu đề và bộ lọc -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <h1 class="text-3xl font-bold">Danh Sách Truyện</h1>
            <div class="flex flex-wrap gap-4">
                <select class="select select-bordered w-full md:w-auto" onchange="window.location.href=this.value">
                    <option value="{{ route('novels.index') }}" {{ !request('category') ? 'selected' : '' }}>Tất cả thể
                        loại</option>
                    @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                        <option value="{{ route('novels.index', ['category' => $category->slug]) }}"
                            {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select class="select select-bordered w-full md:w-auto" onchange="window.location.href=this.value">
                    <option value="{{ route('novels.index') }}" {{ !request('sort') ? 'selected' : '' }}>Mới cập nhật
                    </option>
                    <option value="{{ route('novels.index', ['sort' => 'views']) }}"
                        {{ request('sort') == 'views' ? 'selected' : '' }}>Lượt xem cao</option>
                    <option value="{{ route('novels.index', ['sort' => 'follows']) }}"
                        {{ request('sort') == 'follows' ? 'selected' : '' }}>Theo dõi nhiều</option>
                </select>
            </div>
        </div>

        <!-- Danh sách truyện -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($novels as $novel)
                <x-novels.card-two :novel="$novel"></x-novels.card-two>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="mt-8">
            {{ $novels->links() }}
        </div>
    </div>
</x-guest-layout>
