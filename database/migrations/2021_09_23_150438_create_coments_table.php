<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coments', function (Blueprint $table) {
            $table->id();
            $table->string("text");
            $table->bigInteger("anime_id")->unsigned();
            $table->foreign("anime_id")->references("id")->on("anime")->onDelete('cascade');
            $table->bigInteger("parent_id")->nullable()->unsigned();
            $table->foreign("parent_id")->references("id")->on("coments")->onDelete('cascade');
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('coments');
    }
}
