<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h1 class="card-title text-2xl mb-6">Đăng ký làm tác giả</h1>

                    @if(session('error'))
                        <div class="alert alert-error mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('author-requests.store') }}" method="POST">
                        @csrf

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Tên hiển thị</span>
                            </label>
                            <input type="text" name="pen_name" class="input input-bordered @error('pen_name') input-error @enderror" value="{{ old('pen_name') }}" placeholder="Nhập bút danh của bạn" />
                            @error('pen_name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Giới thiệu bản thân</span>
                            </label>
                            <textarea name="bio" class="textarea textarea-bordered h-32 @error('bio') textarea-error @enderror" placeholder="Giới thiệu ngắn gọn về bản thân và kinh nghiệm viết truyện của bạn">{{ old('bio') }}</textarea>
                            @error('bio')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Lý do muốn trở thành tác giả</span>
                            </label>
                            <textarea name="reason" class="textarea textarea-bordered h-32 @error('reason') textarea-error @enderror" placeholder="Giải thích lý do bạn muốn trở thành tác giả trên trang web của chúng tôi">{{ old('reason') }}</textarea>
                            @error('reason')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Cam kết</span>
                            </label>
                            <textarea name="commitment" class="textarea textarea-bordered h-32 @error('commitment') textarea-error @enderror" placeholder="Cam kết của bạn về việc tuân thủ quy định và đóng góp nội dung chất lượng">{{ old('commitment') }}</textarea>
                            @error('commitment')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">Gửi đơn đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 