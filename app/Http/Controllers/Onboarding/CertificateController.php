<?php

namespace App\Http\Controllers\Onboarding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function add()	{

		return view('account.onboarding.certificates');
	}

	public function store()	{

		$user = auth()->user();

		if($user->certificates()->get()->count() > 0)	{

			$user->registration_step = 4;

			$user->save();	

			if(request()->ajax())	{

				return response()->json(['error' => false]);
			}

			return redirect()->route('dashboard');	
		}
		else {

			abort(422, 'You must add at least one certificate');
		}
	}
}
