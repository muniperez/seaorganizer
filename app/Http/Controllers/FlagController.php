<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Certificate;
use App\Flag;

class FlagController extends Controller
{
    //

    public function json()	{

    	$userFlags = auth()->user()->flags()->get();

    	$flags = array();

    	foreach ($userFlags as $flag) {
    		
    		if(!@$flags[$flag['code']]) {

    			$flags[$flag['code']] = $flag;
    		}
    	}

    	return response()->json($flags);
    }
}
