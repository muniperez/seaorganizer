<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
	public function __invoke()	{

		// Check the registration step and forward accordingly
		switch (auth()->user()->registration_step) {

					case 0:	// Get phone and country
						
						$url = '/onboarding/location';

					break;

					case 1:	// Waiting for phone to be validated
						
						$url = '/onboarding/location';

					break;

					case 2:	// Personal information
						
						$url = '/onboarding/personal';

					break;

					case 3:	// Certificates
						
						$url = '/onboarding/certificates';

					break;

					case 4:	// Subscription
						
						$url = '/subscription/choose';

					break;

					case 10:	// Registration complete, go to dashboard
						
						$url = '/dashboard';

					break;
					
					default:
						
						$url = '/dashboard';
					break;
				}


		return redirect($url);

	}
}
