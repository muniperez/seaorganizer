<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Notifications\ValidatePhone;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class VerificationController extends Controller
{
    //

	public function getPhone()	{

		return view('account.verify.getPhoneNumber');
	}

	public function sendTextCode()	{

		$this->validate(request(), [

			'country_code' => 'required',
			'phone' => 'required',
		]);
		
		$user = Auth::user();
		
		// Get user phone number and save
		$country_code = request('country_code');
		$phone = request('phone');

		$user->phone_country = request('country_code');
		$user->phone = request('phone');
		$user->phone_token = rand(1000,9999);

		$user->save();

		// Send code
		$user->notify(new ValidatePhone($user));

		return redirect('/account/validatePhone');
	}

	public function askTextCode()	{

		return view('account.verify.getPhoneCode');
	}

	public function verifyTextCode()	{

		$this->validate(request(), ['code' => 'required|size:4']);

		$user = Auth::user();

		if($user->phone_token == request('code'))	{

			// Phone is validated
			$user->phone_verified = true;
			$user->phone_token = null;

			$user->update();

			$user->checkVerification();

			return redirect()->route('dashboard')->with('message','E-mail verified!');
		}
		else {

			return back()->with('error', "Code doesn't match");
		}
	}

    public function sendEmailCode()	{

    	Mail::to(auth()->user())->send(new WelcomeEmail(auth()->user()));

    	return back()->with('message', 'Verification e-mail sent');
    }

    public function sendVerificationText()	{

    	$user->notify(new ValidatePhone());
    }

    public function verifyEmailCode($email_token)	{

    	$user = User::whereEmailToken($email_token)->firstOrFail();

    	Auth::login($user, true);

    	$user->email_verified = true;
    	$user->email_token = null;
    	$user->save();

    	$user->checkVerification();

    	return redirect('/dashboard')->with('message','E-mail verified!');
    }
}
