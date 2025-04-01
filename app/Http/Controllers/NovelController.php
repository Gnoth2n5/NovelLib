<?php

namespace App\Http\Controllers;

use App\Http\Requests\Novel\StoreRequest;
use App\Http\Requests\Novel\UpdateRequest;
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
    public function index(Request $request)
    {
        $query = Novel::with(['user', 'categories'])->latest();

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $novels = $query->paginate(12);

        return view('novels.index', compact('novels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('novels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('novels', 'public');
        }

        $novel = Novel::create($data);
        $novel->categories()->attach($request->categories);

        return redirect()->route('novels.show', $novel)
            ->with('success', 'Tạo truyện thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Novel $novel)
    {
        $novel->load(['author', 'categories', 'chapters' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('novels.show', compact('novel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel)
    {
        return view('novels.edit', compact('novel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Novel $novel)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('novels', 'public');
        }

        $novel->update($data);
        $novel->categories()->sync($request->categories);

        return redirect()->route('novels.show', $novel)
            ->with('success', 'Cập nhật truyện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
    {
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }

        $novel->delete();

        return redirect()->route('novels.index')
            ->with('success', 'Xóa truyện thành công!');
    }

    public function like(Novel $novel)
    {
        $user = Auth::user();
        $novel->likes()->toggle($user->id);

        return back();
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