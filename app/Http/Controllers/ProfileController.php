<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $request->user()->update([
                'password' => bcrypt($validated['password']),
            ]);

            return Redirect::route('profile.edit')->with('status', 'password-updated');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật mật khẩu.']);
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'destroy_user_password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        // Xóa ảnh đại diện nếu có
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:1024'],
        ]);

        $user = $request->user();
        
        if ($request->hasFile('photo')) {
            // Xóa ảnh cũ nếu có
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Lưu ảnh mới
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return \redirect()->back()->with('status', 'photo-updated');
    }
}