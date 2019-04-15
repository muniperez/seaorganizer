<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    //

    public function certificatesExpiring()	{

    	// Certificates expiring in 3 months
	    	$certificatesExpiringSoon = auth()->user()->certificates()->expiringWithIn(3);
	    	$certificatesExpiringSoonCount = $certificatesExpiringSoon->count();

            $certificatesExpiring = auth()->user()->certificates()->expiringWithIn([3,6]);
            $certificatesExpiringCount = $certificatesExpiring->count();

        // All certificates

            $certificatesCount = auth()->user()->certificates()->count();

	   	// Flags



    	$data = [

    		'expiringSoon' => 	[
    								'data' => $certificatesExpiringSoon,
    								'count' => $certificatesExpiringSoonCount,
    							],
    		
    		'expiring' => 	[
    							'data' => $certificatesExpiring,
    							'count' => $certificatesExpiringCount,
    						],
            'allGood' => ['count' => $certificatesCount - $certificatesExpiringSoonCount - $certificatesExpiringCount]
    	];

    	return $data;
    }

    public function newsFeed()	{

    	$feeds = ['http://feeds.feedburner.com/gcaptain', 'http://worldmaritimenews.com/feed/' ];
    	$feed = \Feeds::make($feeds);

    	$items = $feed->get_items();

    	$data = [];

    	foreach ($items as $item) {
    		
    		$data[] = 	[
    						'title' => $item->get_title(),
    						'description' => $item->get_description(),
    						'permalink' => $item->get_permalink(),
    						'date' => $item->get_date('j F Y | g:i a'),
    					];
    	}

    	return response()->json($data);
    }

    public function flags()	{

    	$flags = auth()->user()->flags;

    	$flagCounter = [];

    	foreach($flags as $flag)	{

    		if(!@$flagCounter[$flag['code']])	{

    			$counter = ['counter' => 0];
    			$item = array_merge($flag->toArray(), $counter);

    			$flagCounter[$flag['code']] = $item;
    		}

    		$flagCounter[$flag['code']]['counter']++;

    	}

    	$data = ['total' => auth()->user()->certificates()->count(), 'flags' => $flagCounter];

    	return $data;
    }
}
