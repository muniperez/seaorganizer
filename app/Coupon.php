<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

use Stripe\Stripe;

use Stripe\Coupon as StripeCoupon;

class Coupon extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'code';
    }

	public function user()	{

    	return $this->belongsTo('App\User');
    }

    // Sends coupon code to Stripe

    public function activate()	{

    	if($this->status < 2)	{

            if($this->status == 1)  {

                return $this->check();
            }
            else {
            
                Stripe::setApiKey(config('services.stripe.secret'));

                try {

        	    	$coupon = StripeCoupon::create(
        							[
        								"id" => $this->code,
        								"amount_off" => $this->amount,
        								"duration" => "once",
        								"currency" => "USD"
        							]
        						);

        	    	$this->status = 1;
        	    	$this->save();

                    return $coupon;

                }   catch(Exception $e) {

                    return false;
                }
            }
    	}
    }

    public function check()	{

        Stripe::setApiKey(config('services.stripe.secret'));

    	try {

    		$coupon = StripeCoupon::retrieve($this->code);

            if($coupon->valid)  {

                return $coupon;
            }
            else {

                return false;
            }

    	} catch(Exception $e)	{

    		return false;
    	}
    	
    }

    public function applyToSubscription(User $user)  {

        if($user->subscription('main')) {

            Stripe::setApiKey(config('services.stripe.secret'));

            $subscription = \Stripe\Subscription::retrieve($user->subscription('main')->stripe_id);
            $subscription->coupon = $this->code;
            $subscription->save();

            $this->status = 2;
            $this->save();
            
            return $subscription;
        }
        else {

            return false;
        }
    }

    public function deactivate()    {

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
        
            $coupon = StripeCoupon::retrieve($this->code);
            $coupon->delete();
        } catch(Exception $e)   {

            return $e->getMessage();
        }

    }
}
