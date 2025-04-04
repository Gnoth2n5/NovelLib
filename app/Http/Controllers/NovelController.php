<?php

namespace App\Http\Controllers;

use App\Enums\NovelStatus;
use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $novels = Novel::with(['user', 'categories'])
            ->where('status', '!=', NovelStatus::CANCELLED->value)
            ->latest()
            ->paginate(12);

          

        return view('novels.index', compact('novels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Novel $novel)
    {
        $novel->load(['user', 'categories', 'chapters' => function ($query) {
            $query->where('is_published', true)
                ->orderBy('chapter_number');
        }]);

        return view('novels.show', compact('novel'));
    }
    
    public function follow(Novel $novel)
    {
        $user = Auth::user();
        
        /** @var \App\Models\User $user */
        if ($user->followedNovels()->where('novel_id', $novel->id)->exists()) {
            $user->followedNovels()->detach($novel->id);
            $novel->decrement('follows');
            $message = 'Đã bỏ theo dõi truyện!';
        } else {
            $user->followedNovels()->attach($novel->id);
            $novel->increment('follows');
            $message = 'Đã theo dõi truyện!';
        }

        return back()->with('success', $message);
    }
}