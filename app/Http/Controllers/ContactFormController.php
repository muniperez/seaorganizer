<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    //

    public function show()	{

    	return view('frontend.contact-us');
    }

    public function send(Request $request)	{

    	$this->validate($request, 
    					[
    						'name' => 'required',
    						'email' => 'required|email',
    						'subject' => 'required',
                            'message' => 'required',
    					]);

    	$email = (new ContactForm($request))->from($request->email, $request->name)->subject($request->subject);

    	Mail::to(config('mail.to.address'))->send($email);

    	return back()->with('message','Your e-mail has been sent. Thank you!');
    }
}
