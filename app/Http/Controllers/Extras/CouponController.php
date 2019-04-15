<?php

namespace App\Http\Controllers\Extras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Coupon;

class CouponController extends Controller
{
    public function checkInvite()    {

        if(session('inviteCode'))   {

        	// Checks if user already has this coupon initiated
        	$coupon = Coupon::where(['invite_code' => session('inviteCode'), 'user_id' => auth()->user()->id])->first();

        	if(!$coupon)	{

        		// Generates a coupon
        		$coupon = auth()->user()->createCoupon(session('inviteCode'));
        	}

            return response()->json($coupon);
        }

        return response()->json(['hasCode' => false]);
    }

    public function apply(Request $request)    {

    	$this->validate($request, ['code' => 'required']);

    	// Check if coupon exists
    	$coupon = Coupon::where(['code' => $request->input('code')])->firstOrFail();

        // Check if is valid
    	
        if($coupon->activate())	{

            return response()->json($coupon);
        }
        else {

            abort(422, 'Unable to apply coupon');
        }
    }
}
