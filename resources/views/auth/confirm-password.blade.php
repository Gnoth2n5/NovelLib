<x-guest-layout>
    <div class="min-h-screen hero bg-base-200">
        <div class="hero-content flex-col w-full max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold">Xác Nhận Mật Khẩu</h1>
                <p class="py-6 text-base-content/80">
                    Đây là khu vực bảo mật. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.
                </p>
            </div>

            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                        @csrf

                        <!-- Password -->
                        <div class="form-control">
                            <label for="password" class="label">
                                <span class="label-text">Mật khẩu</span>
                            </label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="input input-bordered w-full" 
                                   required 
                                   autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">
                                Xác Nhận
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
