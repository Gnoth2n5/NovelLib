<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'commentable_type' => 'required|string|in:App\Models\Novel,App\Models\Chapter',
            'commentable_id' => 'required|integer'
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->content = $validated['content'];
        $comment->commentable_type = $validated['commentable_type'];
        $comment->commentable_id = $validated['commentable_id'];
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
        $this->authorize('update', $comment);

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
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Bình luận đã được xóa thành công!');
    }

    public function toggleHidden(Comment $comment)
    {
        $this->authorize('toggleHidden', $comment);

        $comment->is_hidden = !$comment->is_hidden;
        $comment->save();

        $message = $comment->is_hidden ? 'Bình luận đã được ẩn!' : 'Bình luận đã được hiện!';
        return back()->with('success', $message);
    }
}
