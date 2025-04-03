# NovelLib - Nền tảng đọc truyện chữ

NovelLib là một nền tảng web cho phép người dùng đọc và chia sẻ truyện chữ, được xây dựng bằng Laravel và DaisyUI.

## Tính năng chính

-   Đăng ký và đăng nhập tài khoản
-   Đọc truyện theo chương
-   Bình luận và đánh giá truyện
-   Tìm kiếm truyện theo tên và thể loại
-   Quản lý truyện và chương (cho tác giả)
-   Quản trị hệ thống (cho admin)
-   Giao diện thân thiện với người dùng

## Yêu cầu hệ thống

-   PHP >= 8.1
-   Composer
-   MySQL >= 5.7
-   Node.js & NPM

## Cài đặt

1. Clone repository:

```bash
git clone https://github.com/yourusername/novellib.git
cd novellib
```

2. Cài đặt các dependencies:

```bash
composer install
npm install
```

3. Tạo file môi trường:

```bash
cp .env.example .env
```

4. Tạo key cho ứng dụng:

```bash
php artisan key:generate
```

5. Cấu hình database trong file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=novellib
DB_USERNAME=root
DB_PASSWORD=
```

6. Chạy migration và seeder:

```bash
php artisan migrate --seed
```

7. Build assets:

```bash
npm run dev
```

8. Chạy server:

```bash
php artisan serve
```

## Tài khoản mặc định

### Admin

-   Email: admin@example.com
-   Password: password

### User

-   Email: user@example.com
-   Password: password

## Cấu trúc thư mục

```
novellib/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   └── Models/
├── resources/
│   └── views/
│       ├── auth/
│       ├── components/
│       └── layouts/
├── routes/
└── database/
    ├── migrations/
    └── seeders/
```

## Công nghệ sử dụng

-   Laravel 11.x
-   DaisyUI
-   TailwindCSS
-   MySQL
-   PHP 8.1+

## Đóng góp

Mọi đóng góp đều được chào đón. Vui lòng:

1. Fork dự án
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit các thay đổi (`git commit -m 'Add some AmazingFeature'`)
4. Push lên branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## License

Dự án được phân phối dưới giấy phép MIT. Xem file `LICENSE` để biết thêm chi tiết.

## Liên hệ

-   Website: [novellib.com](https://novellib.com)
-   Email: support@novellib.com
-   Facebook: [NovelLib](https://facebook.com/novellib)
