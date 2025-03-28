<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tiên Hiệp' => 'Thể loại truyện về tu tiên, tu đạo',
            'Kiếm Hiệp' => 'Thể loại truyện về võ thuật, giang hồ',
            'Ngôn Tình' => 'Thể loại truyện tình cảm lãng mạn',
            'Đô Thị' => 'Thể loại truyện về cuộc sống đô thị hiện đại',
            'Huyền Huyễn' => 'Thể loại truyện về phép thuật, thần thông',
            'Khoa Huyễn' => 'Thể loại truyện về khoa học viễn tưởng',
            'Kỳ Ảo' => 'Thể loại truyện về thế giới kỳ ảo, phép thuật',
            'Lịch Sử' => 'Thể loại truyện về các sự kiện lịch sử',
            'Võng Du' => 'Thể loại truyện về game online, thế giới ảo',
            'Đồng Nhân' => 'Thể loại truyện dựa trên các tác phẩm khác'
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'is_active' => true
            ]);
        }
    }
}
