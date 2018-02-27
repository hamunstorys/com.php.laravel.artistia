<?php

use Illuminate\Database\Seeder;

class StarArtistSongGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed();
    }

    public function seed()
    {
        $data = array('전체','발라드', '댄스', '락', '트로트', '인디', '힙합', '재즈', '일렉', '뮤지컬', '클래식', '퓨전', '인스트루먼트');
        $this->insertColumns($data);
    }

    public function insertColumns(Array $data)
    {
        foreach ($data as $value) {
            $song_genre = new \App\Models\Star\Star_Artist_Song_Genre();
            $song_genre->fill([
                'name' => $value,
            ]);
            $song_genre->save();
        }
    }
}