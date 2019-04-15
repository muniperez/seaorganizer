<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    public function index()	{

    	$users = User::all();

    	return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)	{

    	$this->validate($request,

    		[
    			'name' => 'required',
    			'email' => 'required|email',
    			'password' => 'required'
    		]
    	);

    	$user = User::make();

	    $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->email_verified = true;
        $user->phone_verified = true;
        $user->verified = true;

        $user->registration_step = 10;

        if($request->input('is_admin'))	{
        	$user->level = 2;
        }

        $user->save();

        return back()->with('message', 'User created');
    }
}
