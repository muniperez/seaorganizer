<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    //

    protected $fillable = ['user_id', 'key', 'value'];

    public function user()	{

    	return $this->belongsTo('App\User');
    }

    public function scopeSetting($query, $key)	{

    	return $query->where('key', $key)->get()->first();
    }
}
