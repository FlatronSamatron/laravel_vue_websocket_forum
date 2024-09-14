<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $withCount = ['likedUsers'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'message_user_likes', 'message_id', 'user_id');
    }

    public function getIsLikedAttribute() // is_liked
    {
        return $this->likedUsers()->where('user_id', auth()->id())->exists();
    }

    public function getIsComplainedAttribute() // is_complained
    {
        return $this->complainedUsers()
                ->where('user_id', auth()->id())
                ->where('is_solved', false)
                ->exists();
    }

    public function answeredUsers()
    {
        return $this->belongsToMany(User::class, 'message_user_answers', 'message_id', 'user_id');
    }

    public function complainedUsers()
    {
        return $this->belongsToMany(User::class, 'complaints', 'message_id', 'user_id');
    }
}
