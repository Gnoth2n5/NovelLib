<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Thông tin cá nhân') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Cập nhật thông tin tài khoản của bạn.") }}
        </p>
    </header>


    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="label">
                <span class="label-text">{{ __('Tên') }}</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" required autofocus autocomplete="name" />
            @error('name')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div>
            <label for="email" class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full" required autocomplete="username" />
            @error('email')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-success">{{ __('Đã lưu.') }}</p>
            @endif
        </div>
    </form>
</section>
