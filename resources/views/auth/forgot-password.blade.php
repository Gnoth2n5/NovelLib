<x-guest-layout>
    <div class="min-h-screen hero bg-base-200">
        <div class="hero-content flex-col w-full max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold">Quên Mật Khẩu?</h1>
                <p class="py-6 text-base-content/80">
                    Đừng lo lắng! Hãy nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn liên kết để đặt lại mật khẩu.
                </p>
            </div>

            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-control">
                            <label for="email" class="label">
                                <span class="label-text">Địa chỉ email</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="input input-bordered w-full" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">
                                Gửi Liên Kết Đặt Lại Mật Khẩu
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="link link-hover text-sm">
                                ← Quay lại trang đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
