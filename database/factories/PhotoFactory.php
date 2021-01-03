<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{

    protected $model = Photo::class;

    public function definition()
    {
        return ['title' => $this->faker->word(), 'description' => $this->faker->sentence(),
            'file' => $this->faker->word() . ".png",
            'date' => null, 'width' => rand(0,5000), 'height' => rand(0,5000), 'resolution' => null,
            'user_id' => User::factory(), 'group_id' => Group::factory(), 'created_at' => null, 'updated_at' => null,];
    }
}
