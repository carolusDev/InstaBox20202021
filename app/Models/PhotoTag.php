<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoTag extends Pivot
{
    use HasFactory;

    public function tag()
    {return $this->belongsTo(Tag::class);}

    public function photo()
    {return $this->belongsTo(Photo::class);}
}
