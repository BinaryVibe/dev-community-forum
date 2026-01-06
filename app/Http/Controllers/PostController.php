<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display the homepage with recent posts.
     */
    public function index()
    {
        $dateLimit = Carbon::now()->subDays(7);

        $posts = Post::with('user')
            ->where('created_at', '>=', $dateLimit)
            ->latest()
            ->get();

        // Note: Ensure your home view is named 'index' or 'welcome' based on your structure
        return view('index', compact('posts'));
    }

    /**
     * Display a single post.
     */
    public function show($id)
    {
        // Use findOrFail($id) which automatically looks for the 'id' column
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);

        $post->increment('views');

        $userVote = null;
        if (Auth::check()) {
            $userVote = Vote::where('user_id', Auth::id())
                ->where('post_id', $post->id) // Changed from post_id
                ->first();
        }

        return view('posts.show', compact('post', 'userVote'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $request->user()->posts()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'views' => 0,
            'upvotes' => 0,
            'downvotes' => 0,
        ]);

        // Redirect using the named route 'home'
        return redirect()->route('index')->with('success', 'Post created successfully!');
    }

    /**
     * Handle Upvote/Downvote logic.
     */
    public function vote(Request $request, $id)
    {
        $request->validate(['action' => 'required|in:upvote,downvote']);

        // Find post by standard ID
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $type = $request->action;

        // Check for existing vote
        $existingVote = Vote::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existingVote) {
            // Toggle Off
            if ($existingVote->type === $type) {
                $existingVote->delete();
                $post->decrement($type . 's');
                $msg = 'Vote removed.';
            }
            // Switch Vote
            else {
                $post->decrement($existingVote->type . 's');
                $existingVote->update(['type' => $type]);
                $post->increment($type . 's');
                $msg = 'Vote changed.';
            }
        } else {
            // New Vote
            Vote::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'type' => $type
            ]);
            $post->increment($type . 's');
            $msg = 'Vote recorded.';
        }

        return back()->with('success', $msg);
    }

    /**
     * Store a new comment.
     */
    public function storeComment(Request $request, $id)
    {
        $request->validate(['comment_body' => 'required|string|max:1000']);

        // Find post by standard ID
        $post = Post::findOrFail($id);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->comment_body
        ]);

        return redirect()->route('posts.show', $post->id . '#comments-section')
            ->with('success', 'Comment added!');
    }

    public function allPosts()
    {
        // Fetch all posts, sorted by newest
        // 'with' eager loads the user to prevent database stress
        // paginate(9) shows 9 posts per page
        $posts = Post::with('user')->latest()->paginate(9);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        // Ensure user owns the post
        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('profile.edit')->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $post->delete();

        return back()->with('status', 'Post deleted successfully!');
    }
}