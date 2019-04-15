<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Mbarwick83\Shorty\Facades\Shorty;

class Certificate extends Model
{
    protected $fillable = ['label'];

    protected $appends = [
                            'issued_on', 
                            'expires_on', 
                            'expires_within', 
                            'expires_within_class',
                        ];

    //protected $primaryKey = 'id';
	
    public static function expired()	{

    	$now = new Carbon();

    	return static::where('expiration', '<=', $now)->get();

    }

    public function scopeValid($query)	{	// Use: Certificate::valid

    	$now = new Carbon();

    	return $query->where('expiration', '>', $now);
    }

    public function fileUrl()   {

        $file = $this->file;

        if($file)   {

            $url = Storage::temporaryUrl($file, Carbon::now()->addMinutes(2));

            return $url;    // Shorty::shorten($url);
        }
        else {

            return null;
        }
    }

    public function filePermanentUrl()   {

        $file = $this->file;

        if($file)   {

            $url = Storage::url($file);
            
            return Shorty::shorten($url);
        }
        else {

            return null;
        }
    }

    public function scopeExpired($id)	{
    	$now = new Carbon();
    	return $query->where('expiration', '<=', $now);
    }

    public function scopeUpcoming($query)	{
    	return $query->orderBy('expiration', 'asc');
    }

    public function scopeAlertable($query)   {
        
        // List the certificates that are going to expire within a year, which makes them "alertable", meaning the user will receive alerts about them.

        $limit = (new Carbon())->addDays(360);

        return $query->where('expiration', '<=', $limit);
    }

    public function expires()   {
        
        $c = new Carbon($this->expiration);
        return $c;
    }

    public function date()   {
        return $this->expires()->format('m/d/Y');
    }

    public function issued()   {

        if($this->issued)    {
            return new Carbon($this->issued);
        }
        else {
            return NULL;
        }
    }

    public function issuedDate()   {
        
        if($this->issued()) {
            return $this->issued()->format('m/d/Y');
        }
        else {
            
            return NULL;
        }
    }

    public function expiration()   {

        if($this->expiration)    {
            return new Carbon($this->expiration);
        }
        else {
            return NULL;
        }
    }

    public function expirationDate()   {
        
        if($this->expiration()) {
            return $this->expiration()->format('m/d/Y');
        }
        else {
            return NULL;
        }
    }

    public function class() {
        
        $timeToExpire = $this->expires()->diffInMonths();

        if($timeToExpire >= 6)   {
            // Green
            $status = 'success';
        }
        elseif($timeToExpire > 0 && $timeToExpire < 6)  {
            $status = 'warning';
        }
        else {
            $status = 'danger';
        }

        return $status; 
    }

    public function user()  {
        
        return $this->belongsTo('App\User')->withDefault();
    }

    public function flag()  {
        
        return $this->hasOne('App\Flag')->withDefault();
    }


    public function getIssuedOnAttribute() {

        return $this->attributes['issued_on'] = $this->issuedDate();
    }

    public function getExpiresOnAttribute() {

        return $this->attributes['expires_on'] = $this->expirationDate();
    }

    public function getExpiresWithinAttribute() {

        return $this->attributes['expires_within'] = $this->expiration()->diffForHumans();
    }

    public function getFileUrlAttribute()   {

        return $this->attributes['file_url'] = $this->fileUrl();
    }

    public function getExpiresWithinClassAttribute()  {

        return $this->attributes['expires_within_class'] = $this->class();
    }

    
    public function scopeExpiringWithin($query, $months)    {

        if(is_array($months))   {

            $lowerLimit = (new Carbon())->addMonths(head($months));
            $upperLimit = (new Carbon())->addMonths(last($months));

            $query->where('expiration', '>=', $lowerLimit);
            $query->where('expiration', '<=', $upperLimit);
        }
        else {

            $limitDate = (new Carbon())->addMonths($months);
            $query->where('expiration', '<=', $limitDate);
        }

        return $query->get();
    }
}
