<x-guest-layout>
    <div class="min-h-screen hero bg-base-200">
        <div class="hero-content flex-col w-full max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold">Đăng Ký Tài Khoản</h1>
                <p class="py-6 text-base-content/80">
                    Tạo tài khoản để trải nghiệm đầy đủ các tính năng của NovelLib.
                </p>
            </div>

            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div class="form-control">
                            <label for="name" class="label">
                                <span class="label-text">Họ và tên</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="input input-bordered w-full" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

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
                                   autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

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
                                   autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-control">
                            <label for="password_confirmation" class="label">
                                <span class="label-text">Xác nhận mật khẩu</span>
                            </label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="input input-bordered w-full" 
                                   required 
                                   autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">
                                Đăng Ký
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-sm">Đã có tài khoản? </span>
                            <a href="{{ route('login') }}" class="link link-primary text-sm">
                                Đăng nhập ngay
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
