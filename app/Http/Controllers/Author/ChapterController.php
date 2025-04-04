<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller
{
    public function index(Novel $novel)
    {
        
        $chapters = $novel->chapters()->orderBy('chapter_number')->get();
        return view('author.chapters.index', compact('novel', 'chapters'));
    }

    public function create(Novel $novel)
    {
        return view('author.chapters.form', compact('novel'));
    }

    public function store(Request $request, Novel $novel)
    {

        // \dd($request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
            'is_published' => 'boolean'
        ]);

        $chapter = $novel->chapters()->create($validated);

        return redirect()->route('author.chapters.index', $novel)
            ->with('success', 'Chương đã được tạo thành công!');
    }

    public function pushlish(Novel $novel, Chapter $chapter)
    {
        $chapter->update(['is_published' => true]);

        return redirect()->route('author.chapters.index', $novel)
            ->with('success', 'Chương đã được xuất bản thành công!');
    }

    public function edit(Novel $novel, Chapter $chapter)
    {
        return view('author.chapters.form', compact('novel', 'chapter'));
    }

    public function update(Request $request, Novel $novel, Chapter $chapter)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
            'is_published' => 'boolean'
        ]);

        $chapter->update($validated);

        return redirect()->route('author.chapters.index', $novel)
            ->with('success', 'Chương đã được cập nhật thành công!');
    }

    public function destroy(Novel $novel, Chapter $chapter)
    {

        $chapter->delete();

        return redirect()->route('author.chapters.index', $novel)
            ->with('success', 'Chương đã được xóa thành công!');
    }
} 