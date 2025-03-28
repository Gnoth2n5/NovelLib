<x-guest-layout>
    <!-- Hero Section -->
    <div class="hero min-h-[70vh] bg-base-200" style="background-image: url('https://daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.jpg');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
                <p class="mb-5">Nơi bạn có thể đọc và chia sẻ những câu chuyện thú vị, kết nối với cộng đồng yêu thích truyện chữ.</p>
                <a href="{{ route('novels.index') }}" class="btn btn-primary">Khám Phá Ngay</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <!-- Truyện Mới Nhất -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Truyện Mới Nhất</h2>
                <a href="{{ route('novels.index') }}" class="btn btn-ghost btn-sm">Xem tất cả</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach(\App\Models\Novel::with('user')->latest()->take(4)->get() as $novel)
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
                            <div class="flex gap-2 flex-wrap mt-2">
                                @foreach($novel->categories as $category)
                                    <span class="badge badge-soft badge-primary">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <a href="{{ route('novels.show', $novel) }}" class="btn btn-primary btn-sm">Đọc ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Truyện Nổi Bật -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Truyện Nổi Bật</h2>
                <a href="{{ route('novels.index', ['sort' => 'views']) }}" class="btn btn-ghost btn-sm">Xem tất cả</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach(\App\Models\Novel::orderBy('views', 'desc')->take(4)->get() as $novel)
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
                            <div class="flex items-center gap-2 text-sm text-base-content/70">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                </svg>
                                {{ number_format($novel->views) }}
                            </div>
                            <div class="flex gap-2 flex-wrap mt-2">
                                @foreach($novel->categories as $category)
                                    <span class="badge badge-soft badge-primary">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <a href="{{ route('novels.show', $novel) }}" class="btn btn-primary btn-sm">Đọc ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Danh Mục -->
        <div>
            <h2 class="text-2xl font-bold mb-6">Khám Phá Theo Thể Loại</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach(\App\Models\Category::where('is_active', true)->get() as $category)
                    <a href="{{ route('novels.index', ['category' => $category->slug]) }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                        <div class="card-body items-center text-center">
                            <h3 class="card-title">{{ $category->name }}</h3>
                            <p class="text-sm text-base-content/70">{{ \App\Models\Novel::whereHas('categories', function($query) use ($category) { $query->where('categories.id', $category->id); })->count() }} truyện</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
