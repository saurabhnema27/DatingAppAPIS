<?php

use Illuminate\Database\Seeder;

class UsersDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Userdetail::class, 100)->create()->each(function($userdetails){
            $userdetails->save();
        });
    }
}
