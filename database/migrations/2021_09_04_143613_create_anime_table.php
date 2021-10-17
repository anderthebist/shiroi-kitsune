<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->bigInteger("studio_id")->unsigned();
            $table->foreign("studio_id")->references("id")->on("studios")->onDelete('cascade');
            $table->integer("year");
            $table->string("type");
            $table->string("producer");
            $table->string("contry");
            $table->string("timing");
            $table->string("image");
            $table->string("transfer");
            $table->text("description");
            $table->integer("views")->default(0);
            $table->integer("planned_series");
            $table->boolean("license");
            $table->string("trailer");
            $table->bigInteger("last_video")->unsigned();
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
        Schema::dropIfExists('anime');
    }
}
