<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the profile edit page with user data and their posts.
     */
    public function edit()
    {
        $user = auth()->user();

        // Fetch posts
        $posts = $user->posts()->latest()->get();

        // NEW: Fetch comments (and the post they belong to)
        $comments = $user->comments()->with('post')->latest()->get();

        return view('profile.edit', compact('user', 'posts', 'comments'));
    }
    /**
     * Update user profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // Ensure email/username are unique, but ignore the current user's own record
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validated);

        return back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'], // Laravel's built-in check
            'password' => ['required', 'confirmed', 'min:8'], // Checks password_confirmation
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Password changed successfully!');
    }
}