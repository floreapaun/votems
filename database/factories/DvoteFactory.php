<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Dvote::class, function (Faker $faker) {

    //each candidate has same probability
    $candid_id_arr = array();
    $index = 0;
    for($i = 1; $i < 18; $i++)
        $candid_id_arr[$index++] = $i;
    $candid_id_arr[$index++] = 33;
    $candid_id_arr[$index] = 34;
    

    $county_arr = array();
    for($i = 1; $i < 42; $i++)
        $county_arr[$i - 1] = $i;
    //dd($county_arr);

    $age_arr = array();
    for($i = 15; $i < 81; $i++)
        $age_arr[$i - 15] = $i;


    return [
        'education' => $faker->randomElement([0, 1]),
        'monthly_inc' => $faker->randomElement([1, 2, 3]),
        'family' => $faker->randomElement([-1, 0, 1, 2, 3, 4, 5, 10]),
        'region' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
        'county' => $faker->randomElement($county_arr),
        'age' => $faker->randomElement($age_arr),
        'area' => $faker->randomElement([1, 2]),
        'cand_id' => $faker->randomElement($candid_id_arr),
    ];
});

