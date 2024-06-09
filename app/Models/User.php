<?php

namespace App\Models;

use App\Events\UserCreating;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = ['fullname', 'name', 'email', 'password', 'profile_photo_url', 'bio'];

    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
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

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Relasi untuk following
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
}
