<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ảnh đại diện') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Cập nhật ảnh đại diện của bạn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.photo.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data"
        id="photo-form">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4">
            <div class="avatar">
                <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    @if ($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" 
                            alt="{{ $user->name }}"
                            id="preview-image"
                            class="object-cover w-full h-full" />
                    @else
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="h-12 w-12 text-white" 
                                fill="none"
                                viewBox="0 0 24 24" 
                                stroke="currentColor">
                                <path stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex-1">
                <label for="photo" class="label">
                    <span class="label-text">{{ __('Chọn ảnh mới') }}</span>
                </label>
                <input type="file" name="photo" id="photo" class="file-input file-input-bordered w-full"
                    accept="image/*" onchange="previewImage(this)" />
                @error('photo')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Cập nhật') }}</button>
            <button type="button" class="btn btn-ghost" onclick="cancelPhotoUpdate()">{{ __('Hủy') }}</button>

            @if (session('status') === 'photo-updated')
                <p class="text-sm text-success">{{ __('Đã cập nhật.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    let originalPhotoUrl = "{{ $user->profile_photo ? Storage::url($user->profile_photo) : '' }}";
    let originalPhotoHtml = `@if ($user->profile_photo)
        <img src="{{ Storage::url($user->profile_photo) }}" 
            alt="{{ $user->name }}"
            id="preview-image"
            class="object-cover w-full h-full" />
    @else
        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="h-12 w-12 text-white" 
                fill="none"
                viewBox="0 0 24 24" 
                stroke="currentColor">
                <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
    @endif`;

    function previewImage(input) {
        const previewContainer = document.querySelector('.avatar .rounded-full');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" id="preview-image" class="object-cover w-full h-full" />`;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cancelPhotoUpdate() {
        // Khôi phục ảnh gốc
        const previewContainer = document.querySelector('.avatar .rounded-full');
        previewContainer.innerHTML = originalPhotoHtml;
        
        // Xóa file đã chọn
        document.getElementById('photo').value = '';
        
        // Xóa thông báo lỗi nếu có
        const errorLabel = document.querySelector('.label-text-alt.text-error');
        if (errorLabel) {
            errorLabel.remove();
        }
    }
</script>
