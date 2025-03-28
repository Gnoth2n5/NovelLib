<?php

namespace Database\Seeders;

use App\Models\Novel;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::role('author')->first();
        $categories = Category::all();

        $novels = [
            [
                'title' => 'Tu Tiên Giả',
                'description' => 'Một câu chuyện về con đường tu tiên của một thiếu niên bình thường...',
                'is_completed' => false,
                'is_published' => true,
                'views' => 1000,
                'follows' => 100
            ],
            [
                'title' => 'Kiếm Thánh',
                'description' => 'Hành trình trở thành kiếm thánh của một thiếu niên có tài năng kiếm thuật...',
                'is_completed' => false,
                'is_published' => true,
                'views' => 800,
                'follows' => 80
            ],
            [
                'title' => 'Tình Yêu Vĩnh Cửu',
                'description' => 'Câu chuyện tình yêu lãng mạn giữa hai người trẻ...',
                'is_completed' => true,
                'is_published' => true,
                'views' => 2000,
                'follows' => 200
            ]
        ];

        foreach ($novels as $novel) {
            $novel = Novel::create([
                'user_id' => $author->id,
                'title' => $novel['title'],
                'slug' => Str::slug($novel['title']),
                'description' => $novel['description'],
                'is_completed' => $novel['is_completed'],
                'is_published' => $novel['is_published'],
                'views' => $novel['views'],
                'follows' => $novel['follows']
            ]);

            // Gán ngẫu nhiên 2-3 danh mục cho mỗi truyện
            $novel->categories()->attach(
                $categories->random(rand(2, 3))->pluck('id')->toArray()
            );
        }
    }
}
