<?php

namespace Tests\Exercice1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Cette classe teste le structure de la base de données. Les fichiers de migrations sont nécessaires pour passer ces tests. 
 * La base étant remplie lors de cette étape, les modèles  (sans relations) et les factories sont aussi nécessaires pour lancer ces tests
 * 
 * @author Nicolas Faessel
 */
class A_DatabaseStructureTest extends TestCase
{

    use RefreshDatabase;
    protected $seed = true;
    /**
     * Teste les colonnes de la table correspondant au modèle Comment
     *
     * @return void
     */
    public function testCommentTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('comments', 
                [
                    "id", "text", "comment_id", "photo_id", "user_id", "created_at", "updated_at"
                ]
            ), 1
        );
    }

    /**
     * Teste les colonnes de la table correspondant au modèle Group
     *
     * @return void
     */
    public function testGroupTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('groups', 
                [
                    "id", "name", "description", "created_at", "updated_at"
                ]
            ), 1
        );
    }

    /**
     * Teste les colonnes de la table correspondant au modèle GroupUser
     *
     * @return void
     */
    public function testGroupUserTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('group_user', 
                [
                    "id", "group_id", "user_id", "created_at", "updated_at"
                ]
            ), 1
        );
    }


    /**
     * Teste les colonnes de la table correspondant au modèle Photo
     *
     * @return void
     */
    public function testPhotoTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('photos', 
                [
                    "id", "title", "description", "date", "file", "resolution", "width", "height", "group_id", "user_id", "created_at", "updated_at"
                ]
            ), 1
        );
    }

    /**
     * Teste les colonnes de la table correspondant au modèle PhotoTag
     *
     * @return void
     */
    public function testPhotoTagTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('photo_tag', 
                [
                    "id", "photo_id", "tag_id", "created_at", "updated_at"
                ]
            ), 1
        );
    }


    /**
     * Teste les colonnes de la table correspondant au modèle PhotoUser
     *
     * @return void
     */
    public function testPhotoUserTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('photo_user', 
                [
                    "id", "photo_id", "user_id", "created_at", "updated_at"
                ]
            ), 1
        );
    }

    /**
     * Teste les colonnes de la table correspondant au modèle Tag
     *
     * @return void
     */
    public function testTagTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('tags', 
                [
                    "id", "name", "created_at", "updated_at"
                ]
            ), 1
        );
    }

    /**
     * Teste les colonnes de la table correspondant au modèle User
     *
     * @return void
     */
    public function testUserTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', 
                [
                    "id", "name", "email", "email_verified_at", "password",
                    "created_at", "updated_at"
                ]
            ), 1
        );
    }

}
