<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Country;

class CountriesController extends Controller
{
    
    public function __invoke()	{

    	$countries = Country::all();

    	return response()->json($countries);
    }
}
