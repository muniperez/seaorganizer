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
    
    static $password;
    static $ranks = [
    					'A/B',
    					'Bosun',
    					'Oiler',
    					'Whiper',

    					'Master',
    					'Third Officer',
    					'Second Officer',
    					'First Officer',
    					'Chief Mate',

    					'Third Engineer',
    					'Second Engineer',
    					'First Engineer',
    					'Chief Engineer',

    					'Steward',
    					'Cook',
    					'Chief Cook',
    				];

    $email_verified = $faker->boolean;
    $phone_verified = $faker->boolean;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),

        'phone_country' => $faker->randomNumber(3),
        'phone' => $faker->numberBetween(1000000000, 9999999999),

        'email_verified' => $faker->boolean,
        'phone_verified' => $faker->boolean,
        'verified' => $email_verified == $phone_verified ? true : false,

        'registration_step' => 10,

        'country' => $faker->countryCode,
        'rank' => $faker->randomElement($ranks),
        'location' => $faker->city,
    ];
});
