<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('local')->user()) {
            return $next($request);
        }else{
            return redirect()->route('sign_in');
        }
    
       
    }
}
