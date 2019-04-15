<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // Certificates expiring within 
        $notifications = array();
        $hasNotifications = FALSE;

        return view('dashboard', compact('certificates','notifications','hasNotifications'));
    }

    public function pricing()   {

        return view('home.pricing');
    }
}
