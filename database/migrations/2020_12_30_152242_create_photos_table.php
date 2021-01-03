<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{

    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();$table->string('title');
            $table->text('description');$table->string('file');$table->date('date')->nullable();
            $table->integer('width');$table->integer('height');
            $table->string('resolution')->nullable();

            $table->foreignId("user_id")->nullable()->constrained()->onDelete("set null");
            $table->foreignId("group_id")->constrained()->onDelete("cascade");$table->timestamps();});
    }

    public function down()
    {Schema::dropIfExists('photos');}
}
