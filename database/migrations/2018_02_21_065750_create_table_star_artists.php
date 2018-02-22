<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

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
            $table->integer('guarantee_concert')->nullable()->comment('콘서트 개런티');
            $table->integer('guarantee_metropolitan')->nullable()->comment('수도권/경기 개런티');
            $table->integer('guarantee_central')->nullable()->comment('중부 개런티');
            $table->integer('guarantee_south')->nullable()->comment('남부 개런티');
            $table->string('manager_name')->nullable()->comment('매니저 이름');
            $table->string('manager_phone')->nullable()->comment('매니저 전화번호');
            $table->string('company_name')->nullable()->comment('회사 이름');
            $table->string('company_email')->nullable()->comment('회사 이메일');
            $table->string('picture_url', 2083)->nullable()->comment('사진 주소');
            $table->string('comment')->nullable()->comment('메모');
            $table->timestamps();
        });

        if (!is_dir('public/star/uploads/artist/thumbnails')) {
            Storage::makeDirectory('public/star/uploads/artist/thumbnails');
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
        if (is_dir('public/star/uploads/artist/thumbnails')) {
            Storage::deleteDirectory('public/star/uploads/artist/thumbnails');
        }
    }
}

