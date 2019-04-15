<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $appends = ['code', 'name', 'icon'];


    public function user()  {
        return $this->belongsTo('App\User');
    }

    public function country()  {
        return $this->belongsTo('App\Country');
    }

    public function getCodeAttribute()	{

    	return $this->country->cca2;
    }

    public function getNameAttribute()	{

    	return $this->country->name;
    }

    public function getIconAttribute()	{

    	return $this->country->flag_icon;
    }



    // public function certificate()  {
    //     return $this->belongsTo('App\Certificate');
    // }
}
