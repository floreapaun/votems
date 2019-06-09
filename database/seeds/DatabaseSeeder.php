<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable all mass assignment restrictions
        //Vote::unguard();

        //$this->call(VotesTableSeeder::class);
        $this->call(DvotesTableSeeder::class);

        // Re enable all mass assignment restrictions
        //Vote::reguard();
    }

}
