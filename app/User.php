<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()   {

        parent::boot();

        static::creating( function($user) {

            $user->email_token = str_random(30);
            $user->phone_token = rand(1000,9999);

        });
    }

    public function routeNotificationForNexmo()
    {
        return '+' . $this->phone_country . $this->phone;
    }

    public function checkVerification() {

        if($this->email_verified && $this->phone_verified)  {
            $this->verified = true;
            $this->save();
        }
    }

    public function certificates()  {
        
        return $this->hasMany('App\Certificate');
    }

    public function flags()  {
        
        return $this->hasMany('App\Flag');
    }

    public function settings()  {

        return $this->hasMany('App\UserSetting');
    }

    public function setting($key)   {

        return \App\UserSetting::firstOrCreate([ 'user_id' => $this->id , 'key' => strtoupper($key)]);
    }

    public function calendar()  {

        return $this->hasOne('App\Calendar');
    }

    public function profile()  {

        return $this->hasOne('App\Profile');
    }

    public function coupons()  {

        return $this->hasMany('App\Coupon');
    }

    public function createCoupon($inviteCode)  {

        $coupon = \App\Coupon::make();
        
        $coupon->code = str_random(10);
        $coupon->invite_code = $inviteCode;
        $coupon->amount = 500;
        $coupon->user_id = $this->id;
        
        $coupon->save();

        return $coupon;
    }

    public function invites()   {

        return $this->hasMany('App\UserInvite');
    }

    // public function getInviteCode() {

    //     // Creates code

    //     if(!$this->invite)  {

    //         $invite = new \App\UserInvite(['code' => str_random(10)]);
            
    //         $this->invite()->save($invite);

    //         $this->invite = $this->invite()->first();
    //     }

    //     // Returns invite
        
    //     return $this->invite->coupon();
    // }
}
