<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\UserInvite;

class UserInviteController extends Controller
{
    public function show()	{

    	// Gets the user's invite code
    	$code = auth()->user()->invite_code;
    	$url = url('/invitation/' . $code);

    	return view('account.invite', compact('code', 'url'));
    }

    public function register($invite)	{

        try {

            \App\User::where(['invite_code' => $invite])->firstOrFail();

            session(['inviteCode' => $invite]);

            return redirect()->route('register')->with('message', 'Invite code applied!');

        } catch(Exception $e)  {

            return redirect('/')->with('error', 'Invalid invite code');
        }
    }

    public function hide()  {
        
        \Cookie::queue('hide_invite_alert', 'hide', 5000);

        return back();
    }

    public function sendInvitation(Request $request)  {

        $this->validate($request, ['email' => 'required|email', 'name' => 'required']);

        $invite = UserInvite::make(['name' => $request->input('name'), 'email' => $request->input('email')]);

        auth()->user()->invites()->save($invite);

        $notification = new \App\Notifications\FriendHasBeenInvited(auth()->user(), $invite);

        $invite->notify($notification);

        return redirect()->route('dashboard')->with('message', 'Invite sent!');
    }

    // public function checkOnSession()    {

    //     if(session('inviteCode'))   {

    //         return response()->json(['hasCode' => true, 'inviteCode' => session('inviteCode')]);
    //     }

    //     return response()->json(['hasCode' => false, 'inviteCode' => null]);
    // }

    // public function checkValidity(UserInvite $invite)    {

    //     // Check if is valid

    //     if($invite->checkCode())    {

    //         return response()->json(['valid' => true]);
    //     }
    //     else {

    //         return response()->json(['valid' => false]);
    //     }
    // }
}
