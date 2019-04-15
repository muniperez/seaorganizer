<?php

namespace App\Http\Middleware;

use Closure;

class Subscription
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
        // Checks if the user has a subscription
        if ($request->user() && ! $request->user()->subscribed('main')  && $request->user()->level < 1) {
            
            return redirect()->route('subscribe');
        }

        return $next($request);
    }
}
