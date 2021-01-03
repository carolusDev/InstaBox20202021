<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    use HasFactory;
    public function group() {return $this->belongsTo(Group::class);}
    public function user() {return $this->belongsTo(User::class);}
}
