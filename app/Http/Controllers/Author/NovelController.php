<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{

    protected $user;
    public function __construct()
    {
        /** @var \App\Models\User $user */
        $this->user = Auth::user();
    }

    public function index()
    {
        $novels = $this->user->novels()->with(['categories', 'chapters'])->latest()->get();
        return view('author.novels.index', compact('novels'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('author.novels.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:ongoing,completed,hiatus'
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('novels/covers', 'public');
        }

        $novel = $this->user->novels()->create($validated);
        $novel->categories()->sync($request->categories);

        return redirect()->route('author.dashboard')
            ->with('success', 'Truyện đã được tạo thành công!');
    }

    public function edit(Novel $novel)
    {
        $categories = Category::all();
        return view('author.novels.form', compact('novel', 'categories'));
    }

    public function update(Request $request, Novel $novel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:ongoing,completed,hiatus'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('novels/covers', 'public');
        }

        $novel->update($validated);
        $novel->categories()->sync($request->categories);

        return redirect()->route('author.dashboard')
            ->with('success', 'Truyện đã được cập nhật thành công!');
    }

    public function destroy(Novel $novel)
    {
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }

        $novel->delete();

        return redirect()->route('author.dashboard')
            ->with('success', 'Truyện đã được xóa thành công!');
    }

    
}