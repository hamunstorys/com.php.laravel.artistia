<?php

use Illuminate\Database\Seeder;

class StarUserTableSeeder extends Seeder
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
        $this->CreateAdministrator();
    }

    public function CreateAdministrator()
    {
        $user = new \App\Models\Star\Star_User();
        $user->fill([
            'email' => 'admin@sjculture.co.kr',
            'password' => bcrypt('000000'),
        ]);
        $user->save();
        
//        $authority = new Authority;
//        $authority->fill(['administrator' => 1,
//            'articles_creatable' => 1, 'articles_updatable' => 1, 'articles_deletable' => 1,
//            'comments_creatable' => 1, 'comments_updatable' => 1, 'comments_deletable' => 1
//        ]);
//        $user->Authorities()->save($authority);
//        $authority->save();
    }
}
