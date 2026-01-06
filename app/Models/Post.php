<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'views',
        // 'is_published' removed
        'upvotes',
        'downvotes',
    ];

    // Casts array is empty now as is_published was the only item
    protected $casts = [];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function user()
    {
        // Assuming your Users table uses 'id' as primary key
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // App/Models/Post.php
    public function votes()
    {
        return $this->hasMany(Vote::class, 'post_id', 'post_id');
    }
}