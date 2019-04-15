<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function create()	{

    	$user = auth()->user();

    	return view('account.support.create', compact('user'));
    }

    public function created()	{

    	return view('account.support.created');
    }

    public function form()	{

    	return view('account.support.form');
    }
}
