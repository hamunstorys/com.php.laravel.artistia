<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStarArtistsStarArtistsSongGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artists_star_artists_song_genres', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->integer('artist_id')->unsigned();
            $table->integer('song_genre_id')->unsigned();

            $table->foreign('artist_id')->references('id')
                ->on('star_artists')->onDelete('cascade');
            $table->foreign('song_genre_id')->references('id')
                ->on('star_artists_song_genres')->onDelete('cascade');

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
        Schema::dropIfExists('star_artists_star_artists_song_genres');
    }
}
