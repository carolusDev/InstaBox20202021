<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\PhotoTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhotoTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photo_id' => Photo::factory(), 
            'tag_id' => Tag::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
