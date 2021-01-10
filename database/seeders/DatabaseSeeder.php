<?php
namespace Database\Seeders; use Illuminate\Database\Seeder;
use App\Models\Comment; use App\Models\Group; use App\Models\Photo;
use App\Models\PhotoTag; use App\Models\PhotoUser; use App\Models\Tag; use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //to associate users to a group

        $tags = Tag::all();
        $group = Group::factory()->create();
        $users = User::all();
        $photos = Photo::all();

        User::factory()->count(20)->create();
        Tag::factory()->count(50)->create();

        Photo::factory()->count(10)->create(
            [
                'group_id' => $group->id,
                'user_id' => $users->random()->id
            ]);

        // to comment pic
        foreach($photos as $photo)
        {

            Comment::factory()->count(rand(1,10))
                ->create(['user_id' => $users->random()
                ->id, 'photo_id' => $photo->id]);


            // pic tag
            foreach($tags->random(rand(1,10)) as $tag)
            {
                PhotoTag::factory()->create(['photo_id' => $photo->id, 'tag_id' => $tag->id]);
            }

            foreach($users->random(rand(1,10)) as $user)
            {
                PhotoUser::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]);
            }

        }
    }
}
