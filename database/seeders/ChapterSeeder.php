<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $novels = Novel::all();

        foreach ($novels as $novel) {
            // Tạo 5 chương cho mỗi truyện
            for ($i = 1; $i <= 5; $i++) {
                Chapter::create([
                    'novel_id' => $novel->id,
                    'title' => "Chương {$i}: " . $this->getChapterTitle($novel->title, $i),
                    'slug' => Str::slug("chuong-{$i}-" . $this->getChapterTitle($novel->title, $i)),
                    'content' => $this->getChapterContent($novel->title, $i),
                    'chapter_number' => $i,
                    'is_published' => true,
                    'views' => rand(100, 500)
                ]);
            }
        }
    }

    private function getChapterTitle(string $novelTitle, int $chapterNumber): string
    {
        $titles = [
            'Tu Tiên Giả' => [
                'Khởi đầu tu tiên',
                'Gặp gỡ tiên nhân',
                'Luyện công pháp',
                'Đột phá cảnh giới',
                'Gặp nạn'
            ],
            'Kiếm Thánh' => [
                'Bắt đầu học kiếm',
                'Kiếm tâm',
                'Kiếm thế',
                'Kiếm đạo',
                'Kiếm thánh'
            ],
            'Tình Yêu Vĩnh Cửu' => [
                'Gặp gỡ',
                'Quen biết',
                'Thân thiết',
                'Yêu nhau',
                'Hạnh phúc'
            ]
        ];

        return $titles[$novelTitle][$chapterNumber - 1] ?? "Chương {$chapterNumber}";
    }

    private function getChapterContent(string $novelTitle, int $chapterNumber): string
    {
        $contents = [
            'Tu Tiên Giả' => "Nội dung chương {$chapterNumber} của truyện Tu Tiên Giả...",
            'Kiếm Thánh' => "Nội dung chương {$chapterNumber} của truyện Kiếm Thánh...",
            'Tình Yêu Vĩnh Cửu' => "Nội dung chương {$chapterNumber} của truyện Tình Yêu Vĩnh Cửu..."
        ];

        return $contents[$novelTitle] ?? "Nội dung chương {$chapterNumber}...";
    }
}
