<?php

use Illuminate\Database\Seeder;

class DvotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Dvote', 189)->create(); 
    }
}
