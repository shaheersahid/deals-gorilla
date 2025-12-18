<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the admin profile.
     */
    /**
     * Display the admin profile.
     * 
     * @return View
     */
    public function index(): View
    {
        return view('admin.content.profile.index');
    }

    /**
     * Update the admin profile.
     */
    /**
     * Update the admin profile.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        if ($request->hasFile('avatar')) {
            $path = upload_file($request->file('avatar'), 'avatars');
            
            if ($user->avatar) {
                delete_file($user->avatar->orig_path);
                $user->avatar->update([
                    'orig_path' => $path,
                    'thumb_path' => $path,
                    'description' => 'Avatar',
                ]);
            } else {
                $user->avatar()->create([
                    'orig_path' => $path,
                    'thumb_path' => $path,
                    'description' => 'Avatar',
                ]);
            }
        }

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the admin password.
     */
    /**
     * Update the admin password.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Password changed successfully.');
    }
}
