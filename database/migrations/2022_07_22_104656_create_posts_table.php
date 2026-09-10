<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("header_id")->constraint("headers")->nullable();
            $table->string("titulo", 100);
            $table->string("slug", 110)->unique();
            $table->string("metaSeo", 100)->nullable();
            $table->string("resumen", 220);
            $table->longText("contenido");
            $table->enum("visible", ["N", "S"])->default("S");
            $table->datetime("fechaPublicacion")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
