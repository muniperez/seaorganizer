<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerateCountriesController extends Controller
{
    public function __invoke()	{

    	$countries = collect(json_decode( app('pragmarx.countries')->all() , true) )->map( 

                                function($country)  {

                                    $countryData = [
                                                'name' => $country['name']['common'],
                                                'flag_icon' => $country['flag']['flag-icon'],
                                                'flag_icon_squared' => $country['flag']['flag-icon-squared'],
                                                'capital' => $country['capital'],

                                                'calling_code' => reset($country['callingCode']),
                                                'cca3' => $country['cca3']
                                            ];

                                    return \App\Country::firstOrCreate(
                                                    ['cca2' => $country['cca2']],
                                                    $countryData
                                                );
                                });

    	return response()->json($countries);
    }
}
