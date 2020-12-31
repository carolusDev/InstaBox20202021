<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupUserFactory extends Factory
{

    protected $model = GroupUser::class;

    public function definition()
    {
        return ['user_id' => User::factory(), 'group_id' => Group::factory(), 'created_at' => now(), 'updated_at' => now(),];
    }
}
