<?php

use Faker\Generator as Faker;

$factory->define(App\Certificate::class, function (Faker $faker) {
    
    $issuedDate = $faker->dateTimeBetween('-5 years');
    $expirationDate = Carbon\Carbon::instance($issuedDate)->addYears(5);
    $labels =   [
                    'HUET',
                    'BCO',
                    'BOSIET',
                    'RESCUE BOAT',
                    'BSTS',
                    'AFF',
                    'BSTP',
                    'FRB',
                    'ECDIS',
                    'PSC&RB',
                    'CHEMICAL HANDLING',
                    'RADIO OPERATOR',
                    'MFA',
                    'CTS',
                    'DP',
                    'PDSD',
                    'EFA',
                    'TFC',
                    'BRM',
                    'HLO',
                    'SSO',
                    'MARPOL 73',
                    'GOC',
                ];

    return [
        //
        'user_id' => factory(App\User::class)->create()->id,

        'label' => $faker->randomElement($labels),
        'issuer' => $faker->company,

        'issued' => $issuedDate,
        'expiration' => $expirationDate,
    ];
});
