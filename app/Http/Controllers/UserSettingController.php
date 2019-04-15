<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserSetting;

class UserSettingController extends Controller
{
    //

    public function index()	{

    	if(request('load'))	{

    		$keys = explode(',', request('load'));

    		$settings = collect($keys)->map( function($key) 	{

    			return auth()->user()->setting($key);
    		});
    	}
    	else {

    		$settings = auth()->user()->settings;
    	}

    	return response()->json($settings->pluck('value', 'key'));
    }

    public function show($key)	{

    	$setting = auth()->user()->setting($key);

    	return response()->json($setting->value);
    }

    public function update($key)	{

    	$setting = auth()->user()->setting($key);
    	$setting->value = request('value');
    	$setting->save();

    	return response()->json(request('value'));
    }
}
