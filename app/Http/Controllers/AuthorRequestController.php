<?php

namespace App\Http\Controllers;

use App\Models\AuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorRequestController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorRequests = AuthorRequest::with('user')->latest()->get();
        return view('author-requests.index', compact('authorRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string|min:10'
        ]);

        $authorRequest = AuthorRequest::create([
            'user_id' => Auth::id(),
            'reason' => $validated['reason'],
            'status' => 'pending'
        ]);

        return redirect()->back()
            ->with('success', 'Đơn đăng ký tác giả đã được gửi thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AuthorRequest $authorRequest)
    {
        return view('author-requests.show', compact('authorRequest'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve(AuthorRequest $authorRequest)
    {

        $authorRequest->update([
            'status' => 'approved',
            'admin_note' => request('admin_note')
        ]);

        $authorRequest->user->assignRole('author');

        return redirect()->route('admin.author-requests.index')
            ->with('success', 'Đã phê duyệt yêu cầu tác giả thành công!');
    }

    public function reject(AuthorRequest $authorRequest)
    {
        $authorRequest->update([
            'status' => 'rejected',
            'admin_note' => request('admin_note')
        ]);

        return redirect()->route('admin.author-requests.index')
            ->with('success', 'Đã từ chối yêu cầu tác giả!');
    }
}