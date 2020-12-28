<?php

namespace Tests\Exercice1;

use App\Models\{User, Comment, Group, GroupUser, GroupPhoto, Photo, PhotoUser, PhotoTag, Tag};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Ces tests vérifient les relations belongsToMany et l'existance de classe pivot entre les modèles. Ces relations correspondent aux cardinalités n..n
 * Pour passer les tests de cette classe, vous aurez besoin d'avoir créé les modèles et les relations utilisées dans les fonctions de tests.  : 
 * https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
 * 
 */
class D_ManyToManyRelationTest extends TestCase
{

    
    // TODO : GROUP_USER

    /**
     * Teste la relation entre le modèle Group et le modèle User (les participants du groupe)
     *
     * @return void
     */
    public function testGroupBelongsToManyUsers()
    {
        $group = Group::first();
        // Test 1 : Le nombre d'utilisateur du groupe est bien égal à $nb (le jeu de données fourni dans la fonction).
        //$this->assertEquals($nb, $group->users->count());

        // Test 2: Les utilisateurs sont bien liés au groupe et sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $group->users);

        //Aide : 
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $group->users());
    }

    /**
     * Vérifie la présence du modèle pivot entre les utilisateurs et la table liée au modèle Group
     *
     * @return void
     */
    public function testGroupHasPivotClassForUsers() {
        $group = Group::first();
        $this->assertInstanceOf('App\Models\GroupUser', $group->users()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $group->users()->first()->pivot);
    }

    /**
     * Teste la relation entre le modèle User et le modèle Group (les groupes dans lesquels il participe)
     *
     * @return void
     */
    public function testUserHasManyGroups()
    {
        $user = User::first();
        // Les groupes dont l'utilisateur est participant sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->groups);
        //pour aide : les modèles sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $user->groups());
    }

    /**
     * Vérifie la présence du modèle pivot entre les utilisateurs et la table liée au modèle Group
     *
     * @return void
     */
    public function testUserHasPivotClassForGroups() {
        $user = User::first();
        $this->assertInstanceOf('App\Models\GroupUser', $user->groups()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $user->groups()->first()->pivot);
    }

    // TODO : PHOTO_USER
    /**
     * Teste la relation entre le modèle Photo et le modèle User (pour les photos sur lequel l'utilisateur apparait)
     * 
     * @return void
     */
    public function testUserAppearsOnManyPhoto()
    {
        //photosAppearance
        $user = User::first();
        // Les groupes dont l'utilisateur est participant sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->photosAppearance);
        //pour aide : les modèles sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $user->photosAppearance());
    }

    /**
     * Teste la relation entre le modèle Photo et le modèle User (pour les utilisateur qui apparaissent sur la photo)
     * 
     * @return void
     */
    public function testPhotoBelongsToManyUser()
    {
        $photo = Photo::first();
        // Les groupes dont l'utilisateur est participant sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $photo->users);
        //pour aide : les modèles sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $photo->users());
    }

    /**
     * Vérifie la présence du modèle pivot entre les utilisateurs et la table liée au modèle Photo
     *
     * @return void
     */
    public function testUserHasPivotClassForPhotosAppearance() {
        $user = User::first();
        $this->assertInstanceOf('App\Models\PhotoUser', $user->photosAppearance()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $user->photosAppearance()->first()->pivot);
    }



    /**
     * Vérifie la présence du modèle pivot entre les photos et la table liée au modèle User
     *
     * @return void
     */
    public function testPhotoHasPivotClassForUsers() {
        $photo = Photo::first();
        $this->assertInstanceOf('App\Models\PhotoUser', $photo->users()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $photo->users()->first()->pivot);
    }

    // TODO : PHOTO_TAG
    /**
     * Teste la relation entre le modèle Photo et le modèle Tag
     * 
     * @return void
     */
    public function testPhotoBelongsToManyTag()
    {
        $photo = Photo::first();
        // Les groupes dont l'utilisateur est participant sont bien une collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $photo->tags);
        //pour aide : les modèles sont liés par la bonne relation eloquent.
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $photo->tags());
    }


    /**
     * Vérifie la présence du modèle pivot entre les photos et la table liée au modèle Tag
     *
     * @return void
     */
    public function testPhotoHasPivotClassForTags() {
        $photo = Photo::first();
        $this->assertInstanceOf(PhotoTag::class, $photo->tags()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $photo->tags()->first()->pivot);
    }


    /**
     * Teste la relation entre le modèle Photo et le modèle Tag
     * 
     * @return void
     */
    public function testTagBelongsToManyPhoto()
    {
        $tag = Tag::first();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $tag->photos);
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Relations\BelongsToMany', $tag->photos());
    }

    /**
     * Vérifie la présence du modèle pivot entre les tags et la table liée au modèle Photo
     *
     * @return void
     */
    public function testTagHasPivotClassForPhotos() {
        $tag = Tag::first();
        $this->assertInstanceOf(PhotoTag::class, $tag->photos()->first()->pivot);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\Pivot', $tag->photos()->first()->pivot);
    }

}