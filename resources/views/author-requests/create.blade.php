<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-base-200">
        <div class="w-full max-w-lg p-6">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h1 class="card-title text-3xl font-bold text-center mb-6">Đăng ký làm tác giả</h1>
                    <form action="{{ route('author-requests.store') }}" method="POST">
                        @csrf

                        <div class="form-control mb-4">
                            <label class="label mb-2" for="reason">
                                <span class="label-text font-semibold">Lý do muốn trở thành tác giả</span>
                            </label>
                            <textarea id="reason" name="reason" class="textarea textarea-bordered w-full h-32 @error('reason') textarea-error @enderror" placeholder="Giải thích lý do bạn muốn trở thành tác giả trên trang web của chúng tôi">{{ old('reason') }}</textarea>
                            @error('reason')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary w-full">
                                <span class="font-medium">Gửi đơn đăng ký</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
