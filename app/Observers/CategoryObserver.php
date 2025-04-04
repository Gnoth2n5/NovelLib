<?php

namespace App\Observers;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    // This method is called before a category is created
    public function creating(Category $category)
    {
        // create slug from name
        $category->slug = Str::slug($category->name);
    }

    // This method is called before a category is updated
    public function updating(Category $category)
    {
        // if name is changed, update slug
        if ($category->isDirty('name')) {
            $category->slug = Str::slug($category->name);
        }
    }
}
