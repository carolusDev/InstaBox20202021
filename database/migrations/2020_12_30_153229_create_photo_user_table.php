<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoUserTable extends Migration
{

    public function up()
    {
        Schema::create('photo_user', function (Blueprint $table) {
            $table->id();$table->foreignId("photo_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();$table->unique(["photo_id", "user_id"]);$table->timestamps();});
    }

    public function down()
    {Schema::dropIfExists('photo_user');}
}
