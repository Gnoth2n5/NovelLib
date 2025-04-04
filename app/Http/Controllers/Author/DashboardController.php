<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */
        $novels = $user->novels()->with(['categories', 'chapters'])->latest()->get();
        
        $stats = [
            'total_novels' => $novels->count(),
            'total_chapters' => $novels->sum(function($novel) {
                return $novel->chapters->count();
            }),
            'total_views' => $novels->sum('views'),
            'total_follows' => $novels->sum('follows')
        ];

        return view('author.dashboard', compact('novels', 'stats'));
    }
} 