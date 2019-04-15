<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Calendar;

class CalendarController extends Controller
{
    //

    public function getUrl()   {

        $user = auth()->user();

        if($user->setting('WEBCAL'))    {
            
            if(!auth()->user()->calendar)   {

                $calendar = new \App\Calendar;
                $calendar->key = str_random(40);

                auth()->user()->calendar()->save($calendar);
            }
            else {

                $calendar = auth()->user()->calendar;
            }

            return redirect('webcal://www.seaorganizer.com/calendar/' . $calendar->key);
        }

        else {

            return redirect()->name('dashboard')->with('error','Calendar is disabled');
        }
    }

    public function listEvents(Calendar $calendar)   {

    	// Get the Certificates
    	$certificates = $calendar->user->certificates;

    	// Create Calendar
    	$calendar = new \Eluceo\iCal\Component\Calendar('SeaOrganizer');

    	foreach($certificates as $certificate)	{

    		$event = new \Eluceo\iCal\Component\Event();

    		$event
            ->setDtStart($certificate->expiration())
            ->setDtEnd($certificate->expiration())
            ->setNoTime(true)
            ->setSummary($certificate->label . ' expires');

        	$calendar->addComponent($event);	
    	}
    	
    	header('Content-Type: text/calendar; charset=utf-8');
		header('Content-Disposition: attachment; filename="SeaOrganizer.ics"');

		return $calendar->render();
    }
}
