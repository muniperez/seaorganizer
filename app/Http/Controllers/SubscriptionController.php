<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Coupon;

use App\Events\UserSubscribed;
use App\Events\InvitedPersonJoined;



class SubscriptionController extends Controller
{
    public function create()  {

        $user = auth()->user();

        // Check if user subscription is active. If not, shows the payment form.
        if($user->subscribed('main'))   {

            $user->registration_step = 10;
            $user->save();

            return redirect()->route('onboarding');
        }
        
        return view('account.onboarding.subscription');
    }

    public function store(Request $request) {

        $this->validate($request, ['token' => 'required', 'plan' => 'required']);


        $user = auth()->user();
        $plan = $request->input('plan');

        if($plan == 'month' || $plan == 'year') {

            // Checks if the user is alread signed up to any plan
            if($user->subscribed('main'))   {

                // Swaps to the new plan

                try {
                    
                    $user->subscription('main')->swap($plan);

                    return response()->json(['error' => false, 'plan' => $plan, 'change' => true]);

                } catch(Exception $e)   {

                    return response()->json(['error' => true, 'message' => $e]);
                }

            }
            else {
            
                // User is not subscribed to any plan, then simply tries to subscribe

                try {

                    $subscription = $user->newSubscription('main', $request->input('plan'));

                    if($request->input('coupon'))   {

                        $subscription->withCoupon($request->input('coupon.code'));
                    }

                    $subscription->create($request->input('token'), ['email' => $user->email]);

                    if($request->input('coupon') && session('inviteCode'))   {

                        // Update coupon
                        $coupon = Coupon::where(['code' => $request->input('coupon.code') ])->first();
                        $coupon->status = 2;
                        $coupon->save();

                        // Fires event to apply coupon to Inviter
                        event( new InvitedPersonJoined(session('inviteCode')) );

                    }

                    // Dispatch an event
                    event(new UserSubscribed($user));

                    return response()->json(['error' => false, 'plan' => $plan, 'change' => false]);
                }
                catch (Exception $e) {

                    return response()->json(['error' => true, 'message' => $e]);
                }

            }
        }
        else {

            abort(422, 'Incorrect plan type');
        }
    }

    public function show()  {

        $user = auth()->user();
        $subscription = $user->subscription('main');

        return view('account.subscription.show', compact('subscription', 'user') );
    }

    public function edit()  {

        $subscription = auth()->user()->subscription('main');

        return view('account.subscription.edit', compact('subscription') );
    }

    public function update(Request $request)    {

        $user = auth()->user();

        $user->subscription('main')->swap($request->input('plan'));

        return redirect('/account/subscription')->with('message', 'Subscription updated.');
    }

    public function destroy()   {

        $user = auth()->user();

        $user->subscription('main')->cancel();

        return redirect('/account/subscription')->with('message', 'Subscription cancelled.');
    }

    public function invoice(Request $request, $invoiceId)   {

        return $request->user()->downloadInvoice($invoiceId, [
            'vendor'  => 'SeaOrganizer',
            'product' => 'Subscription'
        ]);
    }
}
