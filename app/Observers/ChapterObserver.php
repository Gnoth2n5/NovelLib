<?php

namespace App\Observers;
use App\Models\Chapter;
use Illuminate\Support\Str;

class ChapterObserver
{
    public function creating(Chapter $chapter)
    {
        $chapter->slug = Str::slug($chapter->title);
    }
    public function updating(Chapter $chapter)
    {
        if ($chapter->isDirty('title')) {
            $chapter->slug = Str::slug($chapter->title);
        }
    }
}
