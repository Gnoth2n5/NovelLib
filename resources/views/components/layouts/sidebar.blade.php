@props(['user'])

<div class="drawer-side">
    <label for="my-drawer-3" class="drawer-overlay"></label>
    <ul class="menu p-4 w-80 min-h-full bg-base-200">
        <li><a href="{{ route('novels.index') }}">Danh Sách Truyện</a></li>
        <div class="divider">Thể Loại</div>
        @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
            <li><a href="{{ route('novels.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
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