<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\PhotoUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoUserFactory extends Factory
{
    protected $model = PhotoUser::class;

    public function definition()
    {return ['photo_id' => Photo::factory(), 'user_id' => User::factory(), 'created_at' => now(), 'updated_at' => now(),];}
}
