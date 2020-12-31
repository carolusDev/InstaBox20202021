<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;

    public function definition()
    {
        return ['user_id' => User::factory(), 'photo_id' => Photo::factory(), 'text' => $this->faker->text, 'comment_id' => null, 'created_at' => now(), 'updated_at' => now(),];
    }
}
