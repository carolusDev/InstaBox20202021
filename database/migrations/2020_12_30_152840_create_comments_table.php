<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();$table->foreignId("user_id")->nullable()->constrained()->onDelete("set null");
            $table->foreignId("photo_id")->constrained()->onDelete("cascade");$table->foreignId("comment_id")->nullable()->constrained()->onDelete("set null");
            $table->text('text');$table->timestamps();});
    }

    public function down()
    {Schema::dropIfExists('comments');}
}
