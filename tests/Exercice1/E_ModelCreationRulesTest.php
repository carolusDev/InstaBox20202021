<?php

namespace Tests\Exercice1;

use App\Models\{User, Comment, Group, GroupUser, GroupPhoto, Photo, PhotoUser, PhotoTag, Tag};
use Tests\TestCase;

/**
 * Ces tests vérifient les règles relatives à la des modèles Photo, Comment, PhotoUser : 
 * 
 * Un commentaire ne peut être que fait que par un utilisateur qui appartient au même groupe que la photo
 * Un commentaire de réponse doit correspondre à la même photo que celui à qui il répond
 * 
 * La photo n'est créée que si son propriétaire appartient bien au même groupe que la photo
 * 
 * Un utilisateur ne peut être ajouté à une photo que si il est dans le même groupe que la photo
 * 
 * Pour réaliser ces contraintes, vous utiliserez les évènements propres aux modèle Eloquents : 
 * https://laravel.com/docs/8.x/eloquent#events
 * 
 * Et implémenterez les contraintes directement dans les modèles correspondants, en utilisant des closures : 
 * https://laravel.com/docs/8.x/eloquent#events-using-closures
 * 
 * 
 */
class E_ModelCreationRulesTest extends TestCase
{


    /**
     * 
     * Vérifie qu'un commentaire ne peut pas être créé par un utilisateur qui n'est pas dans le même groupe que la photo commentée
     * 
     * @return void
     */
    public function testCommentIsNotCreatedByUserWhoDoesNotBelongToSameGroup() {
        $group = Group::first(); 

        //On crée un utilisateur qui n'est pas dans le groupe
        $user = User::factory()->create();
        
        //On récupère une photo du groupe : 
        $photo = $group->photos->first();
        
        // L'utilisateur commente la photo
        $comment = Comment::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]);

          // On vérifie dans la base de donnée que la photo n'a pas été enregistrée
        $this->assertDatabaseMissing('comments', $comment->attributesToArray());
    }

    /**
     * 
     * Vérifie qu'un commentaire peut être créé par un utilisateur qui est dans le même groupe que la photo commentée
     * 
     * @return void
     */
    public function testCommentIsCreatedByUserWhoBelongsToSameGroup() {
        $group = Group::first(); 

        //On récupère un utilisateur qui est dans le groupe
        $user = $group->users->first();

        //On récupère une photo du groupe : 
        $photo = $group->photos->first();

        // L'utilisateur commente la photo
        $comment = Comment::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]);
        
          // On vérifie dans la base de donnée que la photo n'a pas été enregistrée
        $this->assertDatabaseHas('comments', $comment->attributesToArray());
    }



    /**
     * 
     * Vérifie qu'une photo ne peut pas être créé par un utilisateur qui n'est pas dans le même groupe
     * 
     * @return void
     */
    public function testPhotoIsNotCreatedByUserWhoDoesNotBelongToSameGroup() {
        $group = Group::first(); 

        //On crée un utilisateur qui n'est pas dans le groupe
        $user = User::factory()->create();
        
        //On crée une photo : 
        $photo = Photo::factory()->create(['group_id' => $group->id, "user_id" => $user->id]);
        
          // On vérifie dans la base de donnée que la photo n'a pas été enregistrée
        $this->assertDatabaseMissing('photos', $photo->attributesToArray());
    }

    /**
     * 
     * Vérifie qu'une photo est créé par un utilisateur qui est dans le même groupe que la photo
     * 
     * @return void
     */
    public function testPhotoIsCreatedByUserWhoBelongsToSameGroup() {
        $group = Group::first(); 

        //On récupère un utilisateur qui est dans le groupe
        $user = $group->users->first();

        //On crée une photo : 
        $photo = Photo::factory()->create(['group_id' => $group->id, "user_id" => $user->id]);
        
          // On vérifie dans la base de donnée que la photo n'a pas été enregistrée
        $this->assertDatabaseHas('photos', $photo->attributesToArray());
    }


    /**
     * 
     * Vérifie qu'un utilisateur qui n'est pas dans le même groupe qu'une photo ne peut pas être renseigné sur la photo
     * 
     * @return void
     */
    public function testPhotoUserIsNotCreatedForUserWhoDoesNotBelongToSameGroup() {
        $group = Group::first(); 

        //On crée un utilisateur qui n'est pas dans le groupe
        $user = User::factory()->create();
        
        //On récupère une photo du groupe : 
        $photo = $group->photos->first();
        $photo_user = PhotoUser::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]); 
        // On vérifie dans la base de donnée que l'assignation de l'utilisateur à la photo n'est pas enregistrée
        $this->assertDatabaseMissing('photo_user', $photo_user->attributesToArray());
    }

    /**
     * 
     * * Vérifie qu'un utilisateur qui est dans le même groupe qu'une photo peut être renseigné sur la photo
     * 
     * @return void
     */
    public function testPhotoUserIsCreatedForUserWhoBelongsToSameGroup() {
        $group = Group::first(); 

        //On crée un utilisateur qui n'est pas dans le groupe
        $user = User::factory()->create();
        
        //On met l'utilisateur dans le groupe 
        $group_user = GroupUser::factory()->create(['group_id' => $group->id, 'user_id' => $user->id]);
        //On récupère une photo du groupe : 
        $photo = $group->photos->first();
        $photo_user = PhotoUser::factory()->create(['photo_id' => $photo->id, 'user_id' => $user->id]); 
        // On vérifie dans la base de donnée que l'assignation de l'utilisateur à la photo n'est pas enregistrée
        $this->assertDatabaseHas('photo_user', $photo_user->attributesToArray());
    }

}