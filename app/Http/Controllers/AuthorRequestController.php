<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest\StoreRequest;
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
        $requests = AuthorRequest::with('user')->latest()->paginate(10);
        return view('author-requests.index', compact('requests'));
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
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        AuthorRequest::create($data);

        return redirect()->route('author-requests.create')
            ->with('success', 'Yêu cầu đã được gửi thành công!');
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

    public function approve(AuthorRequest $request)
    {
        $request->user->assignRole('author');
        $request->delete();

        return back()->with('success', 'Đã chấp nhận yêu cầu!');
    }

    public function reject(AuthorRequest $request)
    {
        $request->delete();

        return back()->with('success', 'Đã từ chối yêu cầu!');
    }
}