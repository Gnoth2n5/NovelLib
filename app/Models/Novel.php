<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'cover_image',
        'is_completed',
        'is_published',
        'views',
        'follows'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_published' => 'boolean',
        'views' => 'integer',
        'follows' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'novel_category')
            ->withTimestamps();
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows')
            ->withTimestamps();
    }

}
