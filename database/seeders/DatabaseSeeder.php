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
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

                //
                Tag::factory()->count(10)->create();
                $tags = Tag::all();
                User::factory()->count(5)->create();
                $group = Group::factory()->create();  

                //On associe les utilisateurs au groupe créé
                $users = User::all();
                foreach($users as $user) {
                    GroupUser::factory()->create(['group_id' => $group->id, 'user_id' => $user->id]);
                }
                Photo::factory()->count(10)->create(['group_id' => $group->id, 'user_id' => $users->random()->id]);
                $photos = Photo::all();
                foreach($photos as $photo) {
                    // On comment les photos
                    Comment::factory()->count(rand(1,5))->create(['user_id' =>  $users->random()->id, 'photo_id' => $photo->id]);
        
                    // On tag les photos
                    foreach($tags->random(rand(1,3)) as $tag) {
                        PhotoTag::factory()->create(['photo_id' => $photo->id, 'tag_id' => $tag->id]);
                    }
        
                    // On indique les personnes sur la photo
                    foreach($users->random(rand(1,3)) as $user) {
                        PhotoUser::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]);
                    }
                }
                
                // Get at least one reply
                $photoRandom = Photo::all()->random();
                Comment::factory()->count(rand(1,5))->create(['user_id' =>  $users->random()->id, 'photo_id' => $photoRandom->id, 'comment_id' => $photoRandom->comments->random()]);
        
    }
}
