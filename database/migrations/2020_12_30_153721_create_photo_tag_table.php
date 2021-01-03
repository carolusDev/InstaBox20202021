<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTagTable extends Migration
{

    public function up()
    {
        Schema::create('photo_tag', function (Blueprint $table) {
            $table->id();$table->foreignId("photo_id")->constrained()->cascadeOnDelete();
            $table->foreignId("tag_id")->constrained()->cascadeOnDelete();
            $table->unique(["photo_id", "tag_id"]);$table->timestamps();});
    }

    public function down()
    {Schema::dropIfExists('photo_tag');}
}
