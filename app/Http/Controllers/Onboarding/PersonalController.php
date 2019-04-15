<?php

namespace App\Http\Controllers\Onboarding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    public function add()	{

		$countries = \App\Country::all();

		return view('account.onboarding.personal', compact('countries'));
	}

	public function store()	{

		$this->validate(request(), ['rank' => 'nullable', 'state' => 'nullable', 'city' => 'nullable', 'vessel' => 'nullable']);

		$user = auth()->user();
		
		$profile = $user->profile;
		
		$profile->rank = request('rank');
		
		$profile->city = request('city');
		$profile->state = request('state');
		$profile->country_id = request('country_id');

		$profile->vessel = request('vessel');
		
		$profile->save();
		
		$user->registration_step = 3;

		$user->save();

		return redirect('/onboarding');
	}
}
