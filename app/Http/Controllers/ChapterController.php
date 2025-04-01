<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chapter\StoreRequest;
use App\Http\Requests\Chapter\UpdateRequest;
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
        $chapters = $novel->chapters()->orderBy('order')->paginate(20);
        return view('chapters.index', compact('novel', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Novel $novel)
    {
        Gate::authorize('create', $novel);

        $nextChapterNumber = $novel->chapters()->max('chapter_number') + 1;
        return view('chapters.create', compact('novel', 'nextChapterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Novel $novel)
    {
        Gate::authorize('create', $novel);

        $data = $request->validated();
        $data['novel_id'] = $novel->id;

        $chapter = Chapter::create($data);

        return redirect()->route('novels.chapters.show', [$novel, $chapter])
            ->with('success', 'Tạo chương thành công!');
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
        Gate::authorize('update', $chapter);

        return view('chapters.edit', compact('novel', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Novel $novel, Chapter $chapter)
    {
        Gate::authorize('update', $chapter);

        $chapter->update($request->validated());

        return redirect()->route('novels.chapters.show', [$novel, $chapter])
            ->with('success', 'Cập nhật chương thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel, Chapter $chapter)
    {
        Gate::authorize('delete', $chapter);

        $chapter->delete();

        return redirect()->route('novels.chapters.index', $novel)
            ->with('success', 'Xóa chương thành công!');
    }

    public function reorder(Request $request, Novel $novel)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'required|integer|exists:chapters,id'
        ]);

        foreach ($request->orders as $order => $id) {
            Chapter::where('id', $id)->update(['order' => $order + 1]);
        }

        return response()->json(['message' => 'Cập nhật thứ tự chương thành công!']);
    }
}