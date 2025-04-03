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
                'views' => 1000,
                'follows' => 100,
                'status' => 'ongoing'
            ],
            [
                'title' => 'Kiếm Thánh',
                'description' => 'Hành trình trở thành kiếm thánh của một thiếu niên có tài năng kiếm thuật...',
                'views' => 800,
                'follows' => 80,
                'status' => 'completed'
            ],
            [
                'title' => 'Tình Yêu Vĩnh Cửu',
                'description' => 'Câu chuyện tình yêu lãng mạn giữa hai người trẻ...',
                'views' => 2000,
                'follows' => 200,
                'status' => 'hiatus'
            ]
        ];

        foreach ($novels as $novel) {
            $novel = Novel::create([
                'user_id' => $author->id,
                'title' => $novel['title'],
                'slug' => Str::slug($novel['title']),
                'description' => $novel['description'],
                'views' => $novel['views'],
                'follows' => $novel['follows'],
                'status' => $novel['status'],
            ]);

            // Gán ngẫu nhiên 2-3 danh mục cho mỗi truyện
            $novel->categories()->attach(
                $categories->random(rand(2, 3))->pluck('id')->toArray()
            );
        }
    }
}
