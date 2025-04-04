<x-guest-layout>
    <div class="max-w-4xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="card-title text-2xl mb-6">{{ isset($chapter) ? 'Chỉnh sửa chương' : 'Thêm chương mới' }}</h1>

                <form action="{{ isset($chapter) ? route('author.chapters.update', [$novel, $chapter]) : route('author.chapters.store', $novel) }}" 
                      method="POST" 
                      class="space-y-6">
                    @csrf
                    @if(isset($chapter))
                        @method('PUT')
                    @endif

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tiêu đề chương</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               class="input input-bordered @error('title') input-error @enderror" 
                               value="{{ old('title', $chapter->title ?? '') }}" 
                               required />
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">Chương số:</label>
                        <input type="text" 
                               name="chapter_number" 
                               class="input input-bordered @error('chapter_number') input-error @enderror" 
                               value="{{ old('chapter_number', $chapter->chapter_number ?? '') }}" 
                               required />
                        @error('chapter_number')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nội dung</span>
                        </label>
                        <textarea id="content" 
                                  name="content"
                                  class="textarea textarea-bordered h-96 @error('content') textarea-error @enderror" 
                                  >{{ old('content', $chapter->content ?? '') }}</textarea>
                        @error('content')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Xuất bản ngay</span>
                            <input type="checkbox" 
                                   name="is_published" 
                                   class="checkbox" 
                                   {{ old('is_published', $chapter->is_published ?? false) ? 'checked' : '' }} />
                        </label>
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($chapter) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>
                        <a href="{{route('author.chapters.index', $novel)}}" class="btn">Quay lại</a>
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
                .create(document.querySelector('#content'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent',
                        'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'
                    ],
                    language: 'vi',
                })
                .catch(error => {
                    console.error(error);
                });

            document.querySelector('form').addEventListener('submit', function(event) {
                let editorData = null;
                ClassicEditor
                    .create(document.querySelector('#content'))
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
</x-author-layout> 