<?php

namespace App\Http\Controllers;

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
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        return view('novels.index', compact('novels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('novels.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $novel = new Novel();
        $novel->user_id = Auth::id();
        $novel->title = $validated['title'];
        $novel->slug = Str::slug($validated['title']);
        $novel->description = $validated['description'];

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('novels', 'public');
            $novel->cover_image = $path;
        }

        $novel->save();
        $novel->categories()->attach($validated['categories']);

        return redirect()->route('novels.show', $novel)
            ->with('success', 'Truyện đã được tạo thành công!');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel)
    {
        Gate::authorize('update', $novel);
        
        $categories = Category::where('is_active', true)->get();
        return view('novels.edit', compact('novel', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novel $novel)
    {
        Gate::authorize('update', $novel);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
            'is_completed' => 'boolean',
            'is_published' => 'boolean'
        ]);

        $novel->title = $validated['title'];
        $novel->slug = Str::slug($validated['title']);
        $novel->description = $validated['description'];
        $novel->is_completed = $request->boolean('is_completed');
        $novel->is_published = $request->boolean('is_published');

        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ nếu có
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            
            $path = $request->file('cover_image')->store('novels', 'public');
            $novel->cover_image = $path;
        }

        $novel->save();
        $novel->categories()->sync($validated['categories']);

        return redirect()->route('novels.show', $novel)
            ->with('success', 'Truyện đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
    {
        Gate::authorize('delete', $novel);

        // Xóa ảnh bìa nếu có
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }

        $novel->delete();

        return redirect()->route('novels.index')
            ->with('success', 'Truyện đã được xóa thành công!');
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