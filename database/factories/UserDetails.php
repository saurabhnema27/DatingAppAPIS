<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Userdetail::class, function (Faker $faker) {

    $gender = $faker->randomElement(['male', 'female']);
    return [
        'first_name'=> $faker->firstName,
        'last_name'=> $faker->lastName,
        'dob'=> $faker->date,
        'gender'=> $gender,
        'user_name'=> $faker->userName,
        'bio' => $faker->sentence(50),
        'age' => \random_int(20,100),
        'work'=>$faker->company,
        'designation'=>$faker->jobTitle,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'user_id' => factory(App\User::class),

    ];
});
