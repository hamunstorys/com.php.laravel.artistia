<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStarArtistsStarArtistsSexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artists_star_artists_sexes', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->integer('artist_id')->unsigned();
            $table->integer('sex_id')->unsigned();

            $table->foreign('artist_id')->references('id')
                ->on('star_artists')->onDelete('cascade');
            $table->foreign('sex_id')->references('id')
                ->on('star_artists_sexes')->onDelete('cascade');

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
        Schema::dropIfExists('star_artists_star_artists_sexes');
    }
}
