<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'views',
        'is_published',
        'upvotes',
        'downvotes',
    ];  

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
