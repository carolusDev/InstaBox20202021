<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{

    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();$table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("group_id")->constrained()->cascadeOnDelete();
            $table->unique(["user_id", "group_id"]);$table->timestamps();});
    }

    public function down()
    {Schema::dropIfExists('group_user');}
}

