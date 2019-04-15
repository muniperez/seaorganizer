<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Coupon;
use App\Notifications\FriendJoinedWithInvite;

class ApplyCouponToInviter implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        // Find user with invite code

        $user = \App\User::where(['invite_code' => $event->inviteCode])->first();

        if($user)   {

            // Get invite codes
            $invites = Coupon::where(['invite_code' => $event->inviteCode, 'status' => 2])->get();

            if($invites->count() > 0)    {

                // Sum the discounts
                $amount = $invites->sum('amount');

                // Creates a new coupon
                $coupon = Coupon::create(
                                            [
                                                'user_id' => $user->id,
                                                'invite_code' => $event->inviteCode,
                                                'amount' => $amount,
                                                'code' => str_random(10)
                                            ]
                                        );

                // Activate coupon
                $coupon->activate();

                // Apply to subscription
                $response = $coupon->applyToSubscription($user);

                if($response)   {

                    // Notify the user
                    $user->notify(new FriendJoinedWithInvite($coupon));
                }
            }

            $invites->each( function($oldCoupon) {

                $oldCoupon->status = 3;
                $oldCoupon->save();
            });

        }
    }
}
