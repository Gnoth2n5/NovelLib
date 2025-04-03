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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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

                        <li>
                            <x-layouts.dark-mode></x-layouts.dark-mode>
                        </li>


                        <!-- Navbar menu content here -->
                        <li><a href="{{ route('novels.index') }}" class="hover:text-primary">Danh Sách Truyện</a></li>
                        <li class="dropdown dropdown-end">
                            <label tabindex="0" class="hover:text-primary flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                                Thể Loại
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content z-[999] menu p-2 bg-base-100 rounded-box shadow-xl w-52 top-8">
                                @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                                    <li><a href="{{ route('novels.index', ['category' => $category->slug]) }}" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                        </svg>
                                        {{ $category->name }}
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        @auth
                            <li class="dropdown dropdown-end">
                                <label tabindex="0" class="hover:text-primary flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    {{ Auth::user()->name }}
                                </label>
                                <ul tabindex="0"
                                    class="dropdown-content z-[999] menu p-2 bg-base-100 top-8 rounded-box shadow-xl w-52">
                                    @role('admin')
                                        <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0" />
                                            </svg>
                                            Quản lý
                                        </a></li>
                                    @endrole
                                    @role('author')
                                        <li><a href="{{ route('author.dashboard') }}" class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                            </svg>
                                            Trang tác giả
                                        </a></li>
                                    @else
                                        <li><a href="{{ route('author-requests.create') }}" class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Trở thành tác giả
                                        </a></li>
                                    @endrole
                                    <li><a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        Hồ sơ
                                    </a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="flex items-center gap-2 text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                                </svg>
                                                Đăng xuất
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-ghost flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Đăng nhập
                            </a></li>
                            <li><a href="{{ route('register') }}" class="btn btn-primary flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Đăng ký
                            </a></li>
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

    @stack('scripts')

    @include('components.message')
</body>

</html>
