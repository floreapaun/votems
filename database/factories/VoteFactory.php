<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Vote::class, function (Faker $faker) {

    //each candidate has same probability
    $candid_id_arr = array();
    $index = 0;
    for($i = 1; $i < 18; $i++)
        $candid_id_arr[$index++] = $i;
    $candid_id_arr[$index++] = 33;
    $candid_id_arr[$index] = 34;
    

    /*
        $priorities = array(
        6=> 10,
        5=> 40,
        4=> 35,
        3=> 5,
        2=> 5
    );

    # you put each of the values N times, based on N being the probability
    # each occurrence of the number in the array is a chance it will get picked up
    # same is with lotteries
    $numbers = array();
    foreach($priorities as $k=>$v){
        for($i=0; $i<$v; $i++)
            $numbers[] = $k;
    }
     */
    $countydb_arr = DB::table('counties')
        ->select('county_name')
        ->get();
    $county_arr = array();
    for($i = 0; $i < count($countydb_arr); $i++)
        $county_arr[$i] = $countydb_arr[$i]->county_name;
    //dd($county_arr);

    $os_arr = ['Android', 'Linux', 'Windows', 'Linux x86_64'];

    return [
        'user_id' => factory('App\User')->create()->user_id,
        'candidate_id' => $faker->randomElement($candid_id_arr),
        'county_name' => $faker->randomElement($county_arr),
        'vote_time' => date("H:i:s"),
        'vote_date' => date("Y:m:d"),
        'ip' => "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255),
        'os' => $faker->randomElement($os_arr),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
