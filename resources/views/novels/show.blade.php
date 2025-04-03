<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Thông tin truyện -->
        <div class="card bg-base-200 shadow-xl rounded-lg overflow-hidden">
            <div class="card-body p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Cột 1: Ảnh bìa -->
                    <div class="col-span-1">
                        @if ($novel->cover_image)
                            <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                class="w-full rounded-lg shadow-md" />
                        @else
                            <div
                                class="w-full aspect-[3/4] bg-base-300 rounded-lg shadow-md flex items-center justify-center">
                                <span class="text-6xl">📚</span>
                            </div>
                        @endif
                    </div>

                    <!-- Cột 2: Thông tin chi tiết -->
                    <div class="col-span-1 md:col-span-3">
                        <!-- Thể loại -->
                        <div class="mb-4">
                            <span class="badge badge-success badge-sm">Truyện dịch</span>
                        </div>

                        <!-- Tiêu đề -->
                        <h1 class="text-3xl font-bold mb-2 text-base-content">{{ $novel->title }}</h1>

                        <!-- Thông tin cơ bản -->
                        <div class="space-y-2 mb-4 text-base-content/80">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">Tác giả:</span>
                                <span>{{ $novel->user->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">Tình trạng:</span>
                                <span>{{ $novel->is_completed ? 'Hoàn thành' : 'Đang tiến hành' }}</span>
                            </div>
                        </div>

                        <!-- Thể loại -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($novel->categories as $category)
                                <a href="{{ route('novels.index', ['category' => $category->slug]) }}"
                                    class="badge badge-outline badge-sm hover:badge-primary">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        <!-- Thống kê -->
                        <div class="flex flex-wrap items-center gap-6 mb-6 text-base-content">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $novel->followers->count() }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span>{{ number_format($novel->views) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $novel->chapters->count() }} chương</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ number_format($novel->comments->count()) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 112 0v4a1 1 0 01-2 0V7zm-1 8a1 1 0 110-2 1 1 0 010 2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ number_format($novel->views) }}</span>
                            </div>
                        </div>

                        <!-- Nút theo dõi -->
                        <div class="mb-6">
                            <button class="btn btn-warning gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd" />
                                </svg>
                                Tắt nhận thông báo
                            </button>
                        </div>

                        <!-- Tên khác -->
                        @if ($novel->alternative_titles)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2 text-base-content">Tên khác:</h3>
                                <div class="space-y-1 text-base-content/80">
                                    @foreach (explode("\n", $novel->alternative_titles) as $title)
                                        <p>{{ $title }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Tóm tắt -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-base-content">Tóm tắt:</h3>
                            <div class="prose max-w-none text-base-content/80">
                                {!! nl2br(e($novel->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách chương -->
        <div class="mt-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-6">Danh sách chương</h2>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Số chương</th>
                                    <th>Tên chương</th>
                                    <th>Ngày đăng</th>
                                    <th>Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($novel->chapters()->orderBy('id')->get() as $chapter)
                                    <tr class="hover">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('chapters.show', [$novel, $chapter]) }}"
                                                class="link link-hover">
                                                {{ $chapter->title }}
                                            </a>
                                        </td>
                                        <td>{{ $chapter->created_at->format('d/m/Y') }}</td>
                                        <td>{{ number_format($chapter->views) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bình luận -->
        <x-comments.main 
            :route="route('novels.comments.store', $novel)"
            :comments="$novel->comments()->with('user')->where('is_hidden', false)->latest()->get()"
        ></x-comments.main>

    </div>

    @push('scripts')
        <script>
            function editComment(commentId) {
                // TODO: Implement comment editing
            }
        </script>
    @endpush
</x-guest-layout>
