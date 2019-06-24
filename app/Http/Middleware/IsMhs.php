<?php

namespace App\Http\Middleware;

use Closure;

class IsMhs
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
        if(auth()->user()->isMhs()) {
            return $next($request);
        }
        return redirect('/mhs/tasks');
        
    }
}
