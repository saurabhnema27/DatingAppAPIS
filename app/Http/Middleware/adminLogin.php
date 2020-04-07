<?php

namespace App\Http\Middleware;

use Closure;

class adminLogin
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
        // dd(\session()->get('data'));
        
        if($request->session()->get('data') == "") {
            return  redirect('/adminlogout');
        }
        else
        {
            return $next($request);
        }
        
    }
}