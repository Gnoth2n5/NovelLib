<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Show the form for creating a new resource.
     */
    public function create(Novel $novel)
    {
        $this->authorize('create', [Chapter::class, $novel]);

        $nextChapterNumber = $novel->chapters()->max('chapter_number') + 1;
        return view('chapters.create', compact('novel', 'nextChapterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Novel $novel)
    {
        $this->authorize('create', [Chapter::class, $novel]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer|min:1',
            'is_published' => 'boolean'
        ]);

        $chapter = new Chapter();
        $chapter->novel_id = $novel->id;
        $chapter->title = $validated['title'];
        $chapter->slug = Str::slug($validated['title']);
        $chapter->content = $validated['content'];
        $chapter->chapter_number = $validated['chapter_number'];
        $chapter->is_published = $request->boolean('is_published');
        $chapter->save();

        return redirect()->route('chapters.show', [$novel, $chapter])
            ->with('success', 'Chương đã được tạo thành công!');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel, Chapter $chapter)
    {
        $this->authorize('update', $chapter);

        return view('chapters.edit', compact('novel', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novel $novel, Chapter $chapter)
    {
        $this->authorize('update', $chapter);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer|min:1',
            'is_published' => 'boolean'
        ]);

        $chapter->title = $validated['title'];
        $chapter->slug = Str::slug($validated['title']);
        $chapter->content = $validated['content'];
        $chapter->chapter_number = $validated['chapter_number'];
        $chapter->is_published = $request->boolean('is_published');
        $chapter->save();

        return redirect()->route('chapters.show', [$novel, $chapter])
            ->with('success', 'Chương đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel, Chapter $chapter)
    {
        $this->authorize('delete', $chapter);

        $chapter->delete();

        return redirect()->route('chapters.index', $novel)
            ->with('success', 'Chương đã được xóa thành công!');
    }
}