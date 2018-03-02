<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StarUserTableSeeder::class);
        $this->call(StarArtistsSexesTableSeeder::class);
        $this->call(StarArtistsSongGenresTableSeeder::class);

    }
}
