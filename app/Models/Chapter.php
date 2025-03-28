<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'novel_id',
        'title',
        'slug',
        'content',
        'chapter_number',
        'is_published',
        'views'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
        'chapter_number' => 'integer'
    ];

    public function novel(): BelongsTo
    {
        return $this->belongsTo(Novel::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
