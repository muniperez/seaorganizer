<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserInvite extends Model
{
	use Notifiable;
	
	protected $guarded = [];

    public function user()	{

    	return $this->belongsTo('App\User');
    }
}
