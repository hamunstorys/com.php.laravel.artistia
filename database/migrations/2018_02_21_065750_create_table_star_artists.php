<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

class CreateTableStarArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_artists', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('artist_name')->comment('이름');
            $table->bigInteger('guarantee_concert')->nullable();
            $table->bigInteger('guarantee_metropolitan')->nullable();
            $table->bigInteger('guarantee_central')->nullable();
            $table->bigInteger('guarantee_south')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('picture_url', 2083)->nullable();
            $table->string('comment')->nullable()->comment('메모');
            $table->integer('group_type_sex')->unsigned()->nulable();
            $table->integer('group_type_number')->unsigned()->nullble();
            $table->timestamps();
        });
        if (!is_dir('assets/star/uploads/artist/thumbnails')) {
            File::makeDirectory(public_path('assets/star/uploads/artist/thumbnails'), $mode = 0777, true, true);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_artists');

        if (is_dir('assets/star/uploads/artist/thumbnails')) {
            File::deleteDirectory(public_path('assets/star/uploads/artist/thumbnails'));
        }
    }
}
