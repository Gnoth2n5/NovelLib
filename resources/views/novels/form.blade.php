<x-author-layout>
    <div class="max-w-4xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="card-title text-2xl mb-6">{{ isset($novel) ? 'Chỉnh sửa truyện' : 'Thêm truyện mới' }}</h1>

                <form action="{{ isset($novel) ? route('novels.update', $novel) : route('novels.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      class="space-y-6">
                    @csrf
                    @if(isset($novel))
                        @method('PUT')
                    @endif

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tiêu đề</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               class="input input-bordered @error('title') input-error @enderror" 
                               value="{{ old('title', $novel->title ?? '') }}" 
                               required />
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Mô tả</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  class="textarea textarea-bordered h-32 @error('description') textarea-error @enderror" 
                                  required>{{ old('description', $novel->description ?? '') }}</textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Ảnh bìa</span>
                        </label>
                        <input type="file" 
                               name="cover_image" 
                               class="file-input file-input-bordered w-full @error('cover_image') file-input-error @enderror" 
                               accept="image/*" />
                        @error('cover_image')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                        @if(isset($novel) && $novel->cover_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($novel->cover_image) }}" 
                                     alt="Ảnh bìa hiện tại" 
                                     class="w-32 h-32 object-cover rounded-lg" />
                            </div>
                        @endif
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Danh mục</span>
                        </label>
                        <select name="categories[]" 
                                class="select select-bordered @error('categories') select-error @enderror" 
                                multiple 
                                required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ isset($novel) && $novel->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Trạng thái</span>
                            <select name="status" class="select select-bordered">
                                <option value="ongoing" {{ isset($novel) && $novel->status === 'ongoing' ? 'selected' : '' }}>Đang tiến hành</option>
                                <option value="completed" {{ isset($novel) && $novel->status === 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="hiatus" {{ isset($novel) && $novel->status === 'hiatus' ? 'selected' : '' }}>Tạm ngưng</option>
                            </select>
                        </label>
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($novel) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300
        });
    </script>
    @endpush
</x-author-layout> 