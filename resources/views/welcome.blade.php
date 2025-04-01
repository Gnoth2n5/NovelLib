<x-guest-layout>
    <!-- Hero Section -->
    <div class="hero min-h-[70vh] bg-base-200"
        style="background-image: url('https://daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.jpg');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
                <p class="mb-5">Nơi bạn có thể đọc và chia sẻ những câu chuyện thú vị, kết nối với cộng đồng yêu thích
                    truyện chữ.</p>
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
                @foreach (\App\Models\Novel::with('user')->latest()->take(4)->get() as $novel)
                    <x-novels.card-one :novel="$novel"></x-novels.card-one>
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
                @foreach (\App\Models\Novel::orderBy('views', 'desc')->take(4)->get() as $novel)
                    <x-novels.card-two :novel="$novel"></x-novels.card-two>
                @endforeach
            </div>
        </div>

        <!-- Danh Mục -->
        <div>
            <h2 class="text-2xl font-bold mb-6">Khám Phá Theo Thể Loại</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                    <x-categories.card :category="$category"></x-categories.card>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
