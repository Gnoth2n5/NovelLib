<?php

namespace App\Observers;

use App\Models\Novel;

class NovelObserver
{
    // This method is called before a novel is created
    public function creating(Novel $novel)
    {
        // create slug from name
        $novel->slug = \Illuminate\Support\Str::slug($novel->name);
    }

    // This method is called before a novel is updated
    public function updating(Novel $novel)
    {
        // if name is changed, update slug
        if ($novel->isDirty('name')) {
            $novel->slug = \Illuminate\Support\Str::slug($novel->name);
        }
    }
}
