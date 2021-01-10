<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // comment relationship
    public function replies()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replyTo()
    {
        return $this->belongsTo(Comment::class,'comment_id');
    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
