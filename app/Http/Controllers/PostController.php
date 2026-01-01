<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function recent()
    {
        $posts = DB::table('posts as p')
            ->join('users as u', 'p.user_id', '=', 'u.user_id')
            ->select(
                'p.post_id',
                'p.title',
                'p.body',
                'p.views',
                'p.is_published',
                'p.created_at',
                'p.updated_at',
                'p.upvotes',
                'p.downvotes',
                'u.username',
                'u.first_name',
                'u.last_name'
            )
            ->where('p.created_at', '>=', now()->subDays(7))
            ->orderByDesc('p.created_at')
            ->get();

        return view('posts.recent', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        throw new \BadMethodCallException(__METHOD__ . ' is not implemented.');
    }
}
