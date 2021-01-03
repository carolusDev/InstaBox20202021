<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Comment;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Photo;
use App\Models\PhotoTag;
use App\Models\PhotoUser;
use App\Models\Tag;
use App\Models\User;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        Tag::factory()->count(20)->create();$tags = Tag::all();
        User::factory()->count(20)->create();$group = Group::factory()->create();
        $users = User::all();

        foreach($users as $user)
        {GroupUser::factory()->create(['group_id' => $group->id, 'user_id' => $user->id]);}
        Photo::factory()->count(20)->create(['group_id' => $group->id, 'user_id' => $users->random()->id]);
        $photos = Photo::all();

        foreach($photos as $photo)
        {Comment::factory()->count(rand(1,20))->create(['user_id' =>  $users->random()->id, 'photo_id' => $photo->id]);

        foreach($tags->random(rand(1,20)) as $tag) {PhotoTag::factory()->create(['photo_id' => $photo->id, 'tag_id' => $tag->id]);}}
        $photoRandom = Photo::all()->random();
        Comment::factory()->count(rand(1,20))->create(['user_id' =>  $users->random()->id,
            'photo_id' => $photoRandom->id, 'comment_id' => $photoRandom->comments->random()]);
    }
}
