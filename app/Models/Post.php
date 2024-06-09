<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = ['user_id', 'caption', 'image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function savedPosts()
    {
        return $this->hasMany(SavePost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
