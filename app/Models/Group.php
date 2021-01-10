<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this
            ->hasMany(Photo::class);
    }
    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->withTimestamps()
            ->using(GroupUser::class);
    }

}
