<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\Services\SocialFacebookAccountService;

use App\Events\UserSignedUp;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback(SocialFacebookAccountService $service)
    {
        //$user = Socialite::driver('facebook')->user();

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        if($user->registration_step == 0)   {

            event(new UserSignedUp($user));
        }
        
        return redirect()->route('dashboard');
    }
}
