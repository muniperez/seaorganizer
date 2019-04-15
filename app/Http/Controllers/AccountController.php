<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)	{

        $user = auth()->user();
        $user->load('profile');

        $state = $request->get('state');
        $request->session()->put('state',$state);

        $subscription = $user->subscription('main');

    	return view('account.show', compact('user', 'subscription'));
    }

    public function edit()	{

    	return view('account.edit');
    }

    public function update()	{

        $this->validate(request(), [
                                        'name' => 'required',
                                        'email' => 'required|email',
                                        'location' => 'nullable',
                                        'rank' => 'nullable',
                                        'vessel' => 'nullable'
                                    ]);

    	$user = auth()->user();

        $route = 'account';

        $user->email = request('email');
        $user->name = request('name');

        $user->save();

        $user->profile->state = request('state');
        $user->profile->city = request('city');
        $user->profile->country_id = request('country_id');

        $user->profile->rank = request('rank');
        $user->profile->vessel = request('vessel');

    	$user->profile->save();

    	return redirect()->route($route)->with('message', 'Account updated');
    }

    public function changePhone()   {

        return view('account.phone');
    }
}
