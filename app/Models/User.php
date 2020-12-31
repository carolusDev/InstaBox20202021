<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];

    public function photos() {return $this->hasMany(Photo::class);}
    public function photosAppearance() {return $this->belongsToMany(Photo::class)->using(PhotoUser::class)->withPivot('id')->withTimestamps();}
    public function groups() {return $this->belongsToMany(Group::class)->using(GroupUser::class)->withTimestamps();}
    public function comments() {return $this->hasMany(Comment::class);}
}
