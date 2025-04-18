<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Chapter;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Novel $novel, ?Chapter $chapter = null)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        // Xác định $commentable là Novel hay Chapter
        $commentable = $chapter ?? $novel;

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->commentable_type = get_class($commentable);
        $comment->commentable_id = $commentable->id;
        $comment->save();

        return back()->with('success', 'Bình luận đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment->content = $validated['content'];
        $comment->save();

        return back()->with('success', 'Bình luận đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Bình luận đã được xóa thành công!');
    }

    public function toggleHidden(Comment $comment)
    {
        Gate::authorize('toggleHidden', $comment);

        $comment->is_hidden = !$comment->is_hidden;
        $comment->save();

        $message = $comment->is_hidden ? 'Bình luận đã được ẩn!' : 'Bình luận đã được hiện!';
        return back()->with('success', $message);
    }
}
