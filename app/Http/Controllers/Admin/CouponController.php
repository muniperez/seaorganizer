<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;

class CouponController extends Controller
{
    public function index()	{

    	$coupons = Coupon::all();

    	return view('admin.coupons', compact('coupons'));
    }

    public function store(Request $request)	{

    	$this->validate($request, ['code' => 'required', 'amount' => 'required']);

    	$amount = $request->input('amount') * 100;

    	$coupon = new Coupon(['code' => $request->input('code'), 'amount' => $amount ]);
    	$coupon->save();

    	return back()->with('message', 'Coupon created!');

    }

    public function activate(Request $request, Coupon $coupon)	{

    	$coupon->activate();

    	return back()->with('message', 'Coupon updated!');
    }

    public function destroy(Request $request, Coupon $coupon)	{

    	$coupon->deactivate();
        
    	$coupon->delete();

    	return back()->with('message', 'Coupon deleted!');
    }
}
