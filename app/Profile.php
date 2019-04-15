<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $appends = ['location'];

    public function user()  {
        
        return $this->belongsTo('App\User');
    }

    public function country()  {
        
        return $this->belongsTo('App\Country');
    }

    public function getAvatarAttribute()	{

    	if(!$this->avatar_path)	{

    		$avatar_path = 'avatars/' . str_random(10) . '.png';

    		\Avatar::create($this->user->name)->save(storage_path('app/public/' . $avatar_path), 100);

    		$this->avatar_path = $avatar_path;
    		$this->save();
    	}

    	return asset($this->avatar_path);
    }

    public function getLocationAttribute()  {

        $locationItems = [];

        if($this->city) {

            $locationItems[] = $this->city;
        }

        if($this->state)    {

            $locationItems[] = $this->state;
        }

        $locationItems[] = $this->country->name;

        return implode(', ', $locationItems);
    }
}
