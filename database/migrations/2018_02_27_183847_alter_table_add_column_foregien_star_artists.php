<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddColumnForegienStarArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_artists', function (Blueprint $table) {
            $table->integer('group_type_sex')->unsigned()->nullable();

            $table->foreign('group_type_sex')->references('id')->on('star_artist_sexes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('star_artists', function ($table) {
//            $table->dropForeign('star_artist_group_type_song_genre_foreign');
//        });
    }
}
