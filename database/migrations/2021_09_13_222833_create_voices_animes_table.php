<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoicesAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voices_animes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("anime_id")->unsigned();
            $table->foreign('anime_id')
                ->references('id')
                ->on('anime')->onDelete('cascade');
            $table->bigInteger("voice_id")->unsigned();
            $table->foreign('voice_id')
                ->references('id')
                ->on('voices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voices_animes');
    }
}
