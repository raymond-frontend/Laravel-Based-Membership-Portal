<?php

namespace App\Http\Middleware;

use Closure;

class checkMember
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
        if(!$member){
            
            return redirect::back()->withErrors(['message' =>'Membership Id does not exist']);

        }
        return $next($request);
    }
}
