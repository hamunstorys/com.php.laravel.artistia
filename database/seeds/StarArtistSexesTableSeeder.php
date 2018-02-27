<?php

use Illuminate\Database\Seeder;

class StarArtistSexesTableSeeder extends Seeder
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
        $data = array('남성', '여성', '혼성');
        $this->insertColumns($data);
    }

    public function insertColumns(Array $data)
    {

        foreach ($data as $key => $value) {
            $sex = new \App\Models\Star\Star_Artist_Sex();
            $sex->fill([
                'sex' => $value,
                'value' => $key + 1
            ]);
            $sex->save();
        }
    }
}
