<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_animes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("anime_id")->unsigned();
            $table->foreign('anime_id')
                ->references('id')
                ->on('anime')->onDelete('cascade');
            $table->bigInteger("category_id")->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_animes');
    }
}
