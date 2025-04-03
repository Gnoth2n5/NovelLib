<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-6 justify-center">Đăng Nhập</h2>

                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full" required autofocus />
                        <x-input-error :messages="$errors->get('email')"></x-input-error>
                    </div>

                    <!-- Mật khẩu -->
                    <div class="form-control w-full mt-4">
                        <label class="label">
                            <span class="label-text">Mật khẩu</span>
                        </label>
                        <x-input-password></x-input-password>
                        <x-input-error :messages="$errors->get('password')"></x-input-error>
                    </div>

                    <!-- Ghi nhớ đăng nhập -->
                    <div class="form-control mt-4">
                        <label class="label cursor-pointer justify-start gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary" {{ old('remember') ? 'checked' : '' }} />
                            <span class="label-text">Ghi nhớ đăng nhập</span>
                        </label>
                    </div>

                    <div class="card-actions justify-end mt-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="mt-2 link link-hover text-sm">
                                Quên mật khẩu?
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            Đăng nhập
                        </button>
                    </div>

                    <div class="divider mt-6">HOẶC</div>

                    <div class="text-center">
                        <p class="text-sm">Chưa có tài khoản?
                            <a href="{{ route('register') }}" class="link link-primary link-hover">Đăng ký ngay</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</x-guest-layout>
