<?php

namespace App\Http\Middleware;

use Closure;

class Onboarding
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Checks if the user has been through the onboarding process
        if($request->user() && $request->user()->registration_step < 10 && $request->user()->level < 1)    {

            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
