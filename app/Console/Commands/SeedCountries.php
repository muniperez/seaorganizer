<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Country;

class SeedCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seaorganizer:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store countries data in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
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
