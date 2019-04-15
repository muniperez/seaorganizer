<?php

namespace App\Http\Controllers\Onboarding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notifications\ValidatePhone;

class PhoneController extends Controller
{
    public function add()	{

		if(auth()->user()->phone_verified)	{

			redirect('/onboarding');
		}

		return view('account.onboarding.location');

	}

	public function store()	{

		// Stores the phone number and country and send the validation code to the user

		$this->validate(request(), [

					'country_id' => 'required',
					'phone_country' => 'required',
					'phone' => 'required',
				]);

		$user = auth()->user();

		$user->profile->country_id = request('country_id');
		$user->profile->save();
		
		$user->phone_country = request('phone_country');
		$user->phone = request('phone');
		$user->phone_verified = false;
		$user->verified = false;
		$user->phone_token = rand(1000,9999);

		if($user->registration_step < 10)	{

			$user->registration_step = 1;
		}
		
		$user->save();

		// Send phone code
		$user->notify(new ValidatePhone($user));

		//SendPhoneCode::dispatch($user);

		if(request()->ajax())	{

			return response()->json(['error' => false]);
		}

		return redirect('/onboarding');
	}

	public function check()	{

		$this->validate(request(), ['code' => 'required|size:4']);

		$user = auth()->user();

		if($user->phone_token == request('code'))	{

			// Phone is validated
			$user->phone_verified = true;
			$user->phone_token = null;

			if($user->registration_step < 10)	{

				$user->registration_step = 2;
			}

			$user->update();

			$user->checkVerification();

			if(request()->ajax())	{

				return response()->json(['error' => false]);
			}

			return redirect('/onboarding')->with('message','Phone verified!');
		}
		else {

			if(request()->ajax())	{

				abort(403, 'Invalid verification code');
			}

			return back()->with('error', "Invalid verification code");
		}
	}
}
