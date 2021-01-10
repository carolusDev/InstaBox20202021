<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;

class User extends Authenticate
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $casts =
        ['email_verified_at' => 'datetime',];

    public function groups()
    {
        return $this
            ->belongsToMany(Group::class)
            ->using(GroupUser::class)
            ->withTimestamps();
    }
}
