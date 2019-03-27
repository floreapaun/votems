<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    
    $age = array();
    $index = 0;
    for($i = 18; $i < 71; $i++)
        $age[$index++] = $i;

    $family = array();
    $index = 0;
    for($i = -1; $i < 6; $i++)
        $family[$index++] = $i;
    $family[$index] = 10;

    $ok = false;
    while(!$ok) {
        $name = $faker->unique()->name;
        $str_arr = explode(" ", $name);
        if(count($str_arr) == 2) {
            $ok = true;
            $first_name = $str_arr[0];
            $second_name = $str_arr[1];
        }
    }

    return [
        'first_name' => $first_name,
        'second_name' => $second_name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => password_hash("123456", PASSWORD_DEFAULT),
        'age' => $faker->randomElement($age),
        'education' => $faker->randomElement(['0', '1']),
        'income' => $faker->randomElement(['1', '2', '3']),
        'family' => $faker->randomElement($family),
        'remember_token' => str_random(10),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
