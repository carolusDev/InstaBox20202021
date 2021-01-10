<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class)
            ->withPivot('id')
            ->using(PhotoTag::class)
            ->withTimestamps();
    }
    protected static function booted()
    {
        static::creating(function ($p)
        {
            return !is_null($p->owner->groups->find($p->group));
        });
    }
    public function owner()
    {
        return $this
            ->belongsTo(User::class,'user_id','id');
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->withPivot('id')
            ->using(PhotoUser::class)
            ->withTimestamps();
    }

}
