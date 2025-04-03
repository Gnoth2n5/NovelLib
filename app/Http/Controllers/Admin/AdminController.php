<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Novel;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_authors' => User::role('author')->count(),
            'total_novels' => Novel::count(),
            'total_chapters' => DB::table('chapters')->count(),
            'total_comments' => Comment::count(),
            'total_categories' => Category::count(),
        ];

        $latest_users = User::latest()->take(5)->get();
        $latest_novels = Novel::with('user')->latest()->take(5)->get();
        $latest_comments = Comment::with(['user', 'commentable'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_users', 'latest_novels', 'latest_comments'));
    }

    public function users()
    {
        $users = User::with('roles')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
            })
            ->when(request('role'), function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', request('role'));
                });
            })
            ->when(request('is_active'), function ($query) {
                $query->where('is_active', request('is_active'));
            })
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function toggleUserStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        $message = $user->is_active ? 'Tài khoản đã được kích hoạt!' : 'Tài khoản đã bị khóa!';
        return back()->with('success', $message);
    }

    public function novels()
    {
        $novels = Novel::with(['user', 'categories'])
            ->latest()
            ->paginate(20);

        return view('admin.novels.index', compact('novels'));
    }

    public function deleteNovel(Novel $novel)
    {
        $novel->delete();

        return back()->with('success', 'Truyện đã được xóa thành công!');
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'commentable'])
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Bình luận đã được xóa thành công!');
    }
}