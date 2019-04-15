<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \URL::forceScheme('https');

        Validator::extend('pdf64', function ($attribute, $value, $parameters, $validator) {
        
            $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            
                if (in_array($type, $parameters)) {
                    return true;
                }
                
                return false;
        });

        Validator::replacer('pdf64', function($message, $attribute, $rule, $parameters) {
            return str_replace(':values',join(",",$parameters),$message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['request']->server->set('HTTPS', true);
    }
}
