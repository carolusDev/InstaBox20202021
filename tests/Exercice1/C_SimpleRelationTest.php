<?php

namespace Tests\Exercice1;

use App\Models\{User, Comment, Group, Photo};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Ces tests vérifient les relations simples entre les modèles. Ces relations correspondent pour l'instant aux cardinalités 1..n
 * Pour passer les tests de cette classe, vous aurez besoin d'avoir créé les modèles et les relations utilisées dans les fonctions de tests.  : 
 * https://laravel.com/docs/8.x/eloquent-relationships#defining-relationships
 * 
 */
class C_SimpleRelationTest extends TestCase
{

    // Les relations des commentaires
        // 1. Des commentaires vers les modèles associés



    /**
     * Teste la relation entre le modèle Comment et le modèle Photo
     *
     * @return void
     */
    public function testCommentBelongsToAPhoto()
    {
        $comment    = Comment::first();
   
        // Méthode 1 : la photo associé au modèle est un bien une instance de la classe User
        $this->assertInstanceOf(Photo::class, $comment->photo);

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsTo', $comment->photo());

    }

    /**
     * Teste la relation entre le modèle User et le modèle Comment 
     *
     * @return void
     */
    public function testPhotoHasManyComments()
    {
        
        $photo   = Photo::first();

        // Les commentaires sont bien liés à l'utilisateur et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $photo->comments);

        //pour aide : les commentaires sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $photo->comments());
    }

    /**
     * Teste la relation entre le modèle Comment et le modèle User
     *
     * @return void
     */
    public function testCommentBelongsToAnUser()
    {

        $comment = Comment::first();
        // Méthode 1 : l'utilisateur associé au modèle est un bien une instance de la classe User
        $this->assertInstanceOf(User::class, $comment->user);
        
        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsTo', $comment->user());

    }

    /**
     * Teste la relation entre le modèle User et le modèle Comment 
     *
     * @return void
     */
    public function testUserHasManyComments()
    {
        
        $user = User::first();

        // Les commentaires sont bien liés à l'utilisateur et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->comments);

        //pour aide : les commentaires sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $user->comments());
    }

    /**
     * Teste la relation entre le modèle Comment et le modèle Comment
     * 
     * On vérifie qu'un commentaire de réponse répond bien à un commentaire
     *
     * @return void
     */
    public function testCommentIsAReplyToAnotherComment()
    {
        $comment    = Comment::whereNotNull('comment_id')->first();
   
        // La réponse à un commentaire est bien un commentaire.
        $this->assertInstanceOf(Comment::class, $comment->replyTo);

        //pour aide : les commentaires sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $comment->replyTo());

    }


    /**
     * Teste la relation entre le modèle Comment et le modèle Comment
     * 
     * On vérifie qu'un commentaire peut avoir plusieurs réponses. 
     *
     * @return void
     */
    public function testCommentHasManyReplies()
    {
        $commentReply    = Comment::whereNotNull('comment_id')->first()->replyTo;
   
        // Les réponses sont bien liées au commentaire d'origine et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $commentReply->replies);

        //pour aide : les réponses aux commentaires sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $commentReply->replies());

    }

    
    



    /**
     * Teste la relation entre le modèle Photo et le modèle Group, pour vérifier que la photo appartient bien à un groupe
     *
     * @return void
     */
    public function testPhotoBelongsToAGroup()
    {
        $photo    = Photo::first();
        
   
        // Méthode 1 : le groupe de la photo est un bien une instance de la classe Group
        $this->assertInstanceOf(Group::class, $photo->group);
        
        // Méthode 2: Le nombre de groupe de la photo est bien égal à 1
        $this->assertEquals(1, $photo->group()->count());

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsTo', $photo->group());
    }




    // Les relations des groupes 

    /**
     * Teste la relation entre le modèle Group et le modèle Photo
     * 
     * @return void
     */
    public function testGroupHasManyPhotos()
    {

        $group = Group::first();

        // Test : Les photos sont bien liés au groupe et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $group->photos);

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\HasMany', $group->photos());
    }

    /**
     * Teste la relation entre le modèle Photo et le modèle User, pour vérifier qu'il y a bien un propriétaire 
     *
     * @return void
     */
    public function testPhotoBelongsToAnUser()
    {
        $photo    = Photo::first();
   
        // Méthode 1 : le propriétaire de la photo est un bien une instance de la classe User
        $this->assertInstanceOf(User::class, $photo->owner);
        
        // Méthode 2: Le nombre de propriétaires de la photo est bien égal à 1
        $this->assertEquals(1, $photo->owner()->count());

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsTo', $photo->owner());
    }


    /**
     * Teste la relation entre le modèle User et le modèle Photo
     * 
     * @return void
     */
    public function testUserHasManyPhotos()
    {
        
        $user       = User::first();

        // Test : Les photos sont bien liés à l'utilisateur et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->photos);

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\HasMany', $user->photos());
    }

}