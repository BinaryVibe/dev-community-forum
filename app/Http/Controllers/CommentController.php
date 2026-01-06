<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function edit($id)
    {
        // Find comment ensuring it belongs to logged-in user
        $comment = Comment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the comment in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        // Redirect back to profile with success message
        return redirect()->route('profile.edit')->with('status', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $comment->delete();
        return back()->with('status', 'Comment deleted successfully!');
    }
}