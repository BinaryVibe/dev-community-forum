<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show all posts (Dashboard)
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('dashboard', compact('posts'));
    }

    // Show the "Create Post" form
    public function create()
    {
        return view('posts.create');
    }

    // Save the post to Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Save post linked to the logged-in user
        $request->user()->posts()->create($validated);

        return redirect()->route('dashboard');
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}