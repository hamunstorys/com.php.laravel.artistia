<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStarArtistsItemSongGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artists_item_song_genres', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->integer('artist_id')->unsigned();
            $table->integer('song_genre_id')->unsigned();

            $table->foreign('artist_id')->references('id')
                ->on('star_artists')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('song_genre_id')->references('id')
                ->on('star_artists_song_genres')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('star_artists_item_song_genres', function (Blueprint $table) {
            $table->dropForeign('star_artists_item_song_genres_artist_id_foreign');
            $table->dropForeign('star_artists_item_song_genres_song_genre_id_foreign');
        });
        Schema::dropIfExists('star_artists_item_song_genres');
    }
}
