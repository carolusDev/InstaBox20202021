<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($p) {
            return !is_null($p->user->groups->find($p->photo->group));
        });
    }
}
