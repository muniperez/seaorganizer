<?php

use Faker\Generator as Faker;

$factory->define(App\Flag::class, function (Faker $faker) {
    
	$country = $faker->countryCode;

    return [
        //
	        'name' => $country,
	        'code' => $country,
            'icon' => "<span class='flag-icon flag-icon-" . strtolower($country) . "' ></span>",
    ];
});
