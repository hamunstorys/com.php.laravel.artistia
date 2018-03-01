<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStarArtistItemSongGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artist_item_song_genres', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->integer('artist_id')->unsigned()->nullable();
            $table->integer('song_genre_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('artist_id')->references('id')->on('star_artists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('song_genre_id')->references('id')->on('star_artist_song_genres')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_artist_item_song_genres');
    }
}
