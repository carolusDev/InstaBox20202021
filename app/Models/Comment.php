<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::creating(function ($comment) {return !is_null($comment->user->groups->find($comment->photo->group));});
    }
    public function user() {return $this->belongsTo(User::class);}
    public function photo() {return $this->belongsTo(Photo::class);}
    public function replyTo() {return $this->belongsTo(Comment::class,'comment_id','id');}
    public function replies() {return $this->hasMany(Comment::class);}
}
