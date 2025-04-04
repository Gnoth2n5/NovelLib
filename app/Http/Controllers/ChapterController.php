<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Novel $novel)
    {
        $chapters = $novel->chapters()
            ->where('is_published', true)
            ->orderBy('chapter_number')
            ->paginate(20);

        return view('chapters.index', compact('novel', 'chapters'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Novel $novel, Chapter $chapter)
    {
        $chapter->load('novel');
        $chapter->increment('views');

        $prevChapter = $novel->chapters()
            ->where('is_published', true)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        $nextChapter = $novel->chapters()
            ->where('is_published', true)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->orderBy('chapter_number')
            ->first();

        return view('chapters.show', compact('novel', 'chapter', 'prevChapter', 'nextChapter'));
    }

}