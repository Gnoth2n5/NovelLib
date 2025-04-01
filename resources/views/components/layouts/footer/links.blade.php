<div class="w-full">
    <span class="footer-title">Liên Kết</span>
    <a href="{{ route('novels.index') }}" class="link link-hover">Danh Sách Truyện</a>
    @guest
        <a href="{{ route('login') }}" class="link link-hover">Đăng Nhập</a>
        <a href="{{ route('register') }}" class="link link-hover">Đăng Ký</a>
    @endguest
    <a href="{{ route('author-requests.create') }}" class="link link-hover">Trở Thành Tác Giả</a>
</div> 