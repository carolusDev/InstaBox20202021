<?php

namespace Tests\Exercice1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use App\Models\{User, Comment, Group, GroupUser, PhotoUser, Tag, Photo, PhotoTag};
use Tests\TestCase;

/**
 * Ces tests vérifient les contraintes de clés étrangères et d'unicités (pas encore les notions de suppressions)
 * Pour passer les tests de cette classe, vous aurez besoin d'avoir créé les modèles (pour l'instant sans relations) : 
 * https://laravel.com/docs/8.x/eloquent
 * ainsi que les factories associées à chacun des modèles : 
 * https://laravel.com/docs/8.x/database-testing#creating-models-using-factories.  
 * 
 */
class B_DatabaseIntegrityConstraintTest extends TestCase
{

       
    // Gestion des contraintes de clés étrangères provenant de cardinalités 1..n
    // Gestion des contraintes sur les tables d'association / modèles pivots (cardinalités n..n)

    /**
     * Vérifie que la contrainte de clé étrangère pour l'utilisateur est bien prise en compte dans la table liée au modèle GroupUser
     *
     * @return void
     */
    public function testGroupUserDatabaseThrowsIntegrityConstraintExceptionOnNonExistingUserId() 
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        GroupUser::factory()->create(['user_id' =>0]);
    }
    
    /**
     * Vérifie que la contrainte de clé étrangère pour le groupe est bien prise en compte dans la table liée au modèle GroupUser
     *
     * @return void
     */
    public function testGroupUserDatabaseThrowsIntegrityConstraintExceptionOnNonExistingGroupId() 
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        GroupUser::factory()->create(['group_id' =>0]);
    }


    /**
     * Vérifie que la contrainte d'unicité est bien prise en compte dans la table liée au modèle GroupUser
     *
     * @return void
     */
    public function testGroupUserDatabaseThrowsIntegrityConstraintExceptionOnDuplicateEntry() 
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        $user = User::first();
        $group = $user->groups->first();
        GroupUser::factory()->create(['group_id' => $group->id, 'user_id' => $user->id]);
    }



    /**
     * Vérifie que la contrainte de clé étrangère pour la photo est bien prise en compte dans la table liée au modèle PhotoTag
     *
     * @return void
     */
    public function testPhotoTagDatabaseThrowsIntegrityConstraintExceptionOnNonExistingPhotoId() 
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        PhotoTag::factory()->create(['photo_id' =>0]);
    }

    /**
     * Vérifie que la contrainte de clé étrangère pour l'utilisateur est bien prise en compte dans la table liée au modèle PhotoTag
     *
     * @return void
     */
    public function testPhotoTagDatabaseThrowsIntegrityConstraintExceptionOnNonExistingUserId() 
    {
        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        PhotoTag::factory()->create(['tag_id' =>0]);
    }
    
    //TODO : contraintes d'unicité


    /**
     * Vérifie que la contrainte d'unicité est bien prise en compte dans la table liée au modèle GroupUser
     *
     * @return void
     */
    public function testPhotoTagDatabaseThrowsIntegrityConstraintExceptionOnDuplicateEntry() 
    {

        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        $photo = Photo::first();
        $tag = $photo->tags->first();
        PhotoTag::factory()->create(['photo_id' => $photo->id, 'tag_id' => $tag->id]);
    }


    //PHOTO_USER
        /**
     * Vérifie que la contrainte d'unicité est bien prise en compte dans la table liée au modèle GroupUser
     *
     * @return void
     */
    public function testPhotoUserDatabaseThrowsIntegrityConstraintExceptionOnDuplicateEntry() 
    {

        $this->expectException("Illuminate\Database\QueryException");
        $this->expectExceptionCode(23000);
        $photo = Photo::first();
        $user = $photo->users->first();
        PhotoUser::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]);
    }
}
