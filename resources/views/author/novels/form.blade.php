<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl p-6">
            <div class="card-body">
                <h2 class="card-title mb-4">{{ isset($novel) ? 'Sửa truyện' : 'Thêm truyện mới' }}</h2>

                <form action="{{ isset($novel) ? route('author.novels.update', $novel) : route('author.novels.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($novel))
                        @method('PUT')
                    @endif

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Tiêu đề</span>
                        </label>
                        <input type="text" name="title"
                            class="input input-bordered @error('title') input-error @enderror"
                            value="{{ old('title', $novel->title ?? '') }}" required>
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Mô tả</span>
                        </label>
                        <textarea name="description" id="description"
                            class="textarea textarea-bordered h-60 @error('description') textarea-error @enderror">
                            {{ old('description', $novel->description ?? '') }}
                        </textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Ảnh bìa</span>
                        </label>
                        <input type="file" name="cover_image"
                            class="file-input file-input-bordered w-full @error('cover_image') file-input-error @enderror"
                            accept="image/*">
                        @error('cover_image')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                        @if (isset($novel) && $novel->cover_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                    class="w-32 h-40 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Danh mục</span>
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="checkbox checkbox-primary"
                                        {{ isset($novel) && $novel->categories->contains($category->id) ? 'checked' : '' }}>
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('categories')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Trạng thái</span>
                        </label>
                        <select name="status" class="select select-bordered @error('status') select-error @enderror"
                            required>
                            <option value="ongoing"
                                {{ old('status', $novel->status ?? '') === 'ongoing' ? 'selected' : '' }}>Đang tiến
                                hành</option>
                            <option value="completed"
                                {{ old('status', $novel->status ?? '') === 'completed' ? 'selected' : '' }}>Đã hoàn
                                thành</option>
                            <option value="hiatus"
                                {{ old('status', $novel->status ?? '') === 'hiatus' ? 'selected' : '' }}>Tạm ngưng
                            </option>
                        </select>
                        @error('status')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('author.dashboard') }}" class="btn">Hủy</a>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($novel) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .ck-editor__editable_inline {
                min-height: 300px;
            }
            .ck-content {
                height: 100%;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent',
                        'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'
                    ],
                    language: 'vi'
                })
                .catch(error => {
                    console.error(error);
                });

            document.querySelector('form').addEventListener('submit', function(event) {
                let editorData = null;
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .then(editor => {
                        editorData = editor.getData();
                        if (!editorData) {
                            event.preventDefault(); // Ngăn gửi form nếu dữ liệu trống
                            alert('Vui lòng nhập mô tả!');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    @endpush
</x-guest-layout>
