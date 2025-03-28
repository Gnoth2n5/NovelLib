<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased min-h-screen flex flex-col">
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <a href="/" class="btn btn-ghost normal-case text-xl">
                        <span class="text-primary font-bold">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal gap-2">
                        <!-- Navbar menu content here -->
                        <li><a href="{{ route('novels.index') }}" class="hover:text-primary">Danh Sách Truyện</a></li>
                        <li class="dropdown dropdown-hover dropdown-end">
                            <label tabindex="0" class="hover:text-primary">Thể Loại</label>
                            <ul tabindex="0"
                                class="dropdown-content z-[999] menu p-2 bg-base-100 rounded-box shadow-xl w-52 top-4">
                                @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                                    <li><a
                                            href="{{ route('novels.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @auth
                            <li class="dropdown dropdown-hover dropdown-end">
                                <label tabindex="0" class="hover:text-primary">{{ Auth::user()->name }}</label>
                                <ul tabindex="0"
                                    class="dropdown-content z-[999] menu p-2 bg-base-100 rounded-box shadow-xl w-52">
                                    @role('admin')
                                        <li><a href="{{ route('admin.dashboard') }}">Quản lý</a></li>
                                    @endrole
                                    @role('author')
                                        <li><a href="{{ route('author.dashboard') }}">Trang tác giả</a></li>
                                    @else
                                        <li><a href="{{ route('author-requests.create') }}">Trở thành tác giả</a></li>
                                    @endrole
                                    <li><a href="{{ route('profile.edit') }}">Hồ sơ</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Đăng xuất
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-ghost">Đăng nhập</a></li>
                            <li><a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            <!-- Page content here -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-base-200 text-base-content">
                <div class="divider m-0"></div>
                <div class="footer p-10 container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="w-full">
                        <span class="footer-title">Thể Loại</span>
                        @foreach (\App\Models\Category::where('is_active', true)->take(5)->get() as $category)
                            <a href="{{ route('novels.index', ['category' => $category->slug]) }}"
                                class="link link-hover">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <div class="w-full">
                        <span class="footer-title">Liên Kết</span>
                        <a href="{{ route('novels.index') }}" class="link link-hover">Danh Sách Truyện</a>
                        @guest
                            <a href="{{ route('login') }}" class="link link-hover">Đăng Nhập</a>
                            <a href="{{ route('register') }}" class="link link-hover">Đăng Ký</a>
                        @endguest
                        <a href="{{ route('author-requests.create') }}" class="link link-hover">Trở Thành Tác Giả</a>
                    </div>
                    <div class="w-full">
                        <span class="footer-title">Về Chúng Tôi</span>
                        <p class="max-w-md">{{ config('app.name', 'Laravel') }} - Nơi bạn có thể đọc và chia sẻ những
                            câu chuyện thú vị, kết nối với cộng đồng yêu thích truyện chữ.</p>
                        <div class="mt-4 flex gap-4">
                            <a href="mailto:support@example.com" class="link link-hover flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                    <path
                                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                </svg>
                                support@example.com
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200">
                <!-- Sidebar content here -->
                <li><a href="{{ route('novels.index') }}">Danh Sách Truyện</a></li>
                <div class="divider">Thể Loại</div>
                @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                    <li><a
                            href="{{ route('novels.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
                <div class="divider"></div>
                @auth
                    @role('admin')
                        <li><a href="{{ route('admin.dashboard') }}">Quản lý</a></li>
                    @endrole
                    @role('author')
                        <li><a href="{{ route('author.dashboard') }}">Trang tác giả</a></li>
                    @else
                        <li><a href="{{ route('author-requests.create') }}">Trở thành tác giả</a></li>
                    @endrole
                    <li><a href="{{ route('profile.edit') }}">Hồ sơ</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Đăng xuất
                            </a>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-ghost justify-start">Đăng nhập</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary justify-start">Đăng ký</a></li>
                @endauth
            </ul>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
