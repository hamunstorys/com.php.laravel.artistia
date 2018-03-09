<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStarArtistsSexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artists_sexes', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('value');
            $table->timestamps();

        });

        Schema::table('star_artists', function (Blueprint $table) {
            $table->foreign('group_type_sex')->references('id')
                ->on('star_artists_sexes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('star_artists', function (Blueprint $table) {
            $table->dropForeign('star_artists_group_type_sex_foreign');

        });
        Schema::dropIfExists('star_artists_sexes');
    }
}
