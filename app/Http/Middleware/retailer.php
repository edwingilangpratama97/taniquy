<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class retailer
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
        if (Auth::user()->role == 'retailer') {
            return $next($request);            
        }

        return back()->with('failed','Anda Bukan Retailer');
    }
}
