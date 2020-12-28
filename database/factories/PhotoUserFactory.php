<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\PhotoUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhotoUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photo_id' => Photo::factory(), 
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
